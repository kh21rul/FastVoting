<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        // Authenticate the voter
        $this->middleware('vote.auth');

        // Check if the voter can vote
        $this->middleware('vote.can')->except('result');
    }

    /**
     * Go to vote page
     */
    public function index(Request $request, string $voterId)
    {
        $voter = Voter::find($voterId);

        $data['title'] = 'Voting | '. config('app.name');
        $data['voter'] = $voter;

        return view('pages.vote', $data);
    }

    /**
     * Save the vote
     *
     * @param Request $request
     * @param string $voterId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vote(Request $request, string $voterId)
    {
        $voter = Voter::find($voterId);

        // Check if the selected option is valid
        if (! $voter->event->options->contains($request->option_id)) {
            return redirect()->back()->with('error', 'The selected option is invalid.');
        }

        // Save the vote
        $ballot = $voter->ballot()->create([
            'event_id' => $voter->event->id,
            'voter_id' => $voter->id,
            'option_id' => $request->option_id,
        ]);

        if (empty($ballot)) {
            return redirect()->back()->with('error', 'Failed to save your vote.');
        }

        return redirect()->route('vote.result', ['voterId' => $voter->id, 'token' => $voter->token]);
    }

    /**
     * Go to the result page
     *
     * @param Request $request
     * @param string $voterId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function result(Request $request, string $voterId)
    {
        $voter = Voter::find($voterId);

        // Check if voter has already voted
        if (empty($voter->ballot)) {
            return redirect()->route('vote', ['voterId' => $voter->id, 'token' => $voter->token]);
        }

        $data['title'] = ($voter->event->finished_at->isFuture() ? 'Real-Count' : 'Voting Result') . ' of ' . $voter->event->title . ' | ' . config('app.name');
        $data['voter'] = $voter;
        $data['event'] = $voter->event;

        return view('pages.result', $data);
    }
}
