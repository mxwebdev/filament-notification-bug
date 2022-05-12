<?php

namespace App\Http\Controllers;

use App\Models\GigResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GigResponseController extends Controller
{
    /**
     * Accept a gig invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\GigResponse  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, GigResponse $gigResponse)
    {
        $gigResponse->status = GigResponse::STATUS_ACCEPTED;
        $gigResponse->responded_at = Carbon::now();
        $gigResponse->save();

        return redirect(route('gigs.show', ['gig' => $gigResponse->gig->id]));
    }

    /**
     * Decline a gig invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\GigResponse  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline(Request $request, GigResponse $gigResponse)
    {
        $gigResponse->status = GigResponse::STATUS_DECLINED;
        $gigResponse->responded_at = Carbon::now();
        $gigResponse->save();

        return redirect(route('gigs.show', ['gig' => $gigResponse->gig->id]));
    }

    /**
     * Update the authenticated user's gig response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $gigResponse = GigResponse::findOrFail($request->gig_response_id);

        $gigResponse->status = $request->new_status;
        $gigResponse->responded_at = Carbon::now();
        $gigResponse->save();

        return redirect(route('gigs.show', $gigResponse->gig->id), 303);
    }
}
