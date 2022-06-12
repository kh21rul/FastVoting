<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Go to vote page
     */
    public function index(Request $request, $voterId)
    {
        $voter = Voter::find($voterId);

        // Check if voter exists
        if (!$voter) {
            abort(404, 'Voter not found');
        }

        // Check if token is valid
        if ($voter->token !== $request->token) {
            abort(401, 'Token is invalid');
        }

        // Check if voter has voted
        if ($voter->ballot) {
            abort(403, 'Voter has already voted');
        }

        // Check if the vote is already opened
        if (now() < $voter->event->started_at) {
            abort(403, 'Voting has not started yet');
        }

        // Check if the vote is not closed yet
        if (now() > $voter->event->finished_at) {
            abort(403, 'Voting has been closed');
        }

        $data['title'] = 'Voting | '. config('app.name');
        $data['voter'] = $voter;

        return view('pages.vote', $data);
    }
}
