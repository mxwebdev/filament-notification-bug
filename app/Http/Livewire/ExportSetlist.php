<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use GuzzleHttp\Psr7\Request;
use Aws\Signature\SignatureV4;
use Barryvdh\DomPDF\Facade\Pdf;
use Aws\Credentials\Credentials;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ExportSetlist extends Component
{
    public $gig;
    public $showSlideOver = false;

    public $settings = [
        "titlePage" => true,
        "placeholders" => true,
        "doublePages" => false,
    ];
    
    protected $listeners = ['openExportSetlistSlideOver' => 'openSlideOver'];

    public function openSlideOver()
    {
        $this->showSlideOver = true;
    }

    public function closeSlideOver()
    {
        $this->showSlideOver = false;
    }

    public function callFileMergerApi()
    {
        if ($this->settings["titlePage"]) {
            $this->generateTitlePage();
        }

        if ($this->settings["placeholders"]) {
            $this->generatePlaceholders();
        }

        $body = $this->getRequestBody();

        // Start: API Call
        $client = new Client();
        $headers = ['Content-Type' => 'application/json', 'User-Agent' => 'null'];

        $request = new Request('POST', env('AWS_LAMBDA_FUNCTION_URL'), $headers, $body);

        $credentials = new Credentials(env('AWS_LAMBDA_ACCESS_KEY_ID'), env('AWS_LAMBDA_SECRET_ACCESS_KEY'));
        $s4 = new SignatureV4("lambda", env('AWS_DEFAULT_REGION'));

        $signedRequest = $s4->signRequest($request, $credentials);

        $response = $client->sendAsync($signedRequest)->wait();
        $responseContent = json_decode($response->getBody()->getContents(), true);
        // End: API Call

        //return Storage::disk("s3")->download("output/46208eaf-adfd-46c8-8d8c-25c34a0f2cfc.pdf");
        return Storage::disk("s3")->download($responseContent["path"]);
    }

    public function generatePlaceholders()
    {
        $songs = $this->gig->songs;

        foreach ($songs as $song) {

            // Create placeholder if no user file is present and placeholder does not exist already
            if (!$song->userFile()->exists() && !$song->placeholder()->exists()) {
                $pdfData = ["title" => $song->title];
                $pdfContent = PDF::loadView("pdf.placeholder", $pdfData)->output();
                
                $disk = Storage::disk('s3');

                $name = uniqid() . '.pdf';

                if ($disk->put($name, $pdfContent)) {
                    // Save to media collection if successfully stored
                    $song->addMediaFromDisk($disk->path($name), 's3')->toMediaCollection('placeholders');
                }
            }

        }

        $this->gig = $this->gig->fresh();
    }

    public function generateTitlePage()
    {
        if (!$this->gig->titlePage->exists()) {
            $pdfData = ['title' => $this->gig->name];
            $pdfContent = PDF::loadView('pdf.title-page', $pdfData)->output();

            $disk = Storage::disk('s3');

            $name = 'title_pages/'.uniqid().'.pdf';

            if ($disk->put($name, $pdfContent)) {
                // Save to media collection if successfully stored
                $this->gig->addMediaFromDisk($disk->path($name), 's3')->toMediaCollection('title_pages');
            }

            $this->gig = $this->gig->fresh();
        }
    }

    public function getRequestBody()
    {
        $songs = $this->gig->songs;

        $fileArray = array();
        $fileIds = array();

        $options = [
            'double_pages' => $this->settings["doublePages"],
        ];

        if ($this->settings["titlePage"]) {
            $fileArray[] = [
                'song_id' => null, 
                'file_id' => $this->gig->titlePage->id,
                'file_path' => $this->gig->getFirstMedia('title_pages')->getPath(),
            ];
        }

        foreach ($songs as $song) {

            if ($song->userFile()->exists()) {
                $file = $song->userFile;

                $fileIds[] = $file->id;

                $fileArray[] = [
                    'song_id' => $song->id, 
                    'file_id' => $file->id,
                    'file_path' => $file->getFirstMedia('sheets')->getPath(),
                ];
            }
            elseif ($this->settings["placeholders"]) {
                $fileArray[] = [
                    'song_id' => $song->id, 
                    'file_id' => $song->placeholder->id,
                    'file_path' => $song->getFirstMedia('placeholders')->getPath(),
                ];
            }

        }
        
        $token = $this->generateToken($fileIds);

        $response = ['id' => $token, 'options' => $options, 'files' => $fileArray];

        return json_encode($response);

    }

    public function generateToken(Array $fileIds)
    {
        $fileIdsWithOpt = $fileIds;
        $fileIdsWithOpt[] = $this->settings["doublePages"];

        $token = md5(serialize($fileIdsWithOpt));

        return $token;
    }

    public function render()
    {
        return view('livewire.export-setlist');
    }
}
