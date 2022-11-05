<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Song;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileManager extends Component
{
    use WithFileUploads;

    public Song $song;
    public File $selectedFile;
    public $uploadedFile;

    public $test;

    public $showDeleteModal = false;
    public $showPreviewModal = false;

    protected $listeners = ['saveFile'];

    protected $rules = [
        'uploadedFile' => 'required|mimes:jpeg,jpg,png,pdf|max:5000',
    ];

    public function mount(Song $song)
    {
        $this->song = $song;
    }

    public function saveFile(): void
    {
        $this->validate();

        $file = $this->song->files()->create([
            'owner_id' => auth()->user()->id,
        ]);

        $file->addMediaFromDisk($this->uploadedFile->getRealPath(), 's3')->toMediaCollection('sheets');

        foreach ($this->song->files as $detachFile) {
            $detachFile->users()->detach(auth()->id());
        }
        
        $file->users()->attach(auth()->id());

        $this->resetFields();
    }

    public function resetFields()
    {
        $this->dispatchBrowserEvent('filePondReset');

        $this->song->load('files');
    }

    public function attachFileToUser(File $file)
    {
        foreach ($this->song->files as $detachFile) {
            $detachFile->users()->detach(auth()->id());
        }

        $file->users()->attach(auth()->user());

        $this->song->load('files');
    }

    // public function openDeleteModal(File $file)
    // {
    //     $this->selectedFile = $file;

    //     $this->showDeleteModal = true;
    // }

    public function deleteFile(File $file)
    {
        $file->users()->detach(auth()->user());
        $file->delete();

        $this->song->load('files');
    }

    // public function openPreviewModal(File $file)
    // {
    //     $this->selectedFile = $file;
        
    //     $this->showPreviewModal = true;
    // }

    public function render()
    {
        return view('livewire.file-manager');
    }
}
