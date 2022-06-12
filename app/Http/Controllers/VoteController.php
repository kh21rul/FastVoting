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

        $data['title'] = 'Voting | '. config('app.name');
        $data['voter'] = $voter;

        return view('pages.vote', $data);
    }

    /**
     * Save the vote
     * @param Request $request
     * @param string $voterId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vote(Request $request, $voterId)
    {
        $voter = Voter::find($voterId);

        // Check if the selected option is valid
        if (!$voter->event->options->contains($request->option_id)) {
            return redirect()->back()->with('error', 'The selected option is invalid.');
        }

        // Save the vote
        $ballot = $voter->ballot()->create([
            'event_id' => $voter->event->id,
            'voter_id' => $voter->id,
            'option_id' => $request->option_id,
        ]);

        if (!isset($ballot)) {
            return redirect()->back()->with('error', 'Failed to save your vote.');
        }

        return redirect()->route('result', ['eventId' => $voter->event->id]);
    }
}
