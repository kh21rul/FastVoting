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

        // Check if the event is already started
        if ($voter->event->started_at->isFuture()) {
            return redirect()->route('vote', ['voterId' => $voter->id, 'token' => $voter->token])->with('error', 'The vote has been closed.');
        }

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

        return redirect()->route('result', ['event' => $voter->event, 'token' => $voter->token]);
    }

    /**
     * Go to result page
     */
    public function result(Request $request, Event $event)
    {
        // Authorize the user is the event's creator or the voter who already vote.
        if (!$this->isAuthorizedToResultPage($request, $event)) {
            abort(403, 'Unauthorized');
        }

        // Check if the event is already committed
        if (!$event->is_committed) {
            // Redirect to detail event page if the logged in user is the event's creator.
            if (auth()->user()->id === $event->user_id) {
                return redirect()->route('event.detail', ['id' => $event->id])->with('error', 'This event has not been committed yet.');
            }

            // Redirect to home page.
            return redirect()->route('home')->with('error', 'This event is not committed yet. Please wait for the event creator to commit the event.');
        }

        $data['title'] = ((now() < $event->finished_at) ? 'Real-Count': 'Voting Result') . ' of ' . $event->title . ' | ' . config('app.name');
        $data['event'] = $event;

        return view('pages.result', $data);
    }

    /**
     * Authorize access to result page.
     */
    private function isAuthorizedToResultPage(Request $request, Event $event)
    {
        // Authorize if the user is the voter who already vote.
        if (isset($request->token)) {
            $voter = Voter::where('token', $request->token)->first();

            if (!isset($voter) || $voter->event->id !== $event->id) {
                return false;
            }

            if (!isset($voter->ballot)) {
                return redirect()->route('vote', ['voterId' => $voter->id, 'token' => $voter->token]);
            }

            return true;
        }

        // Authorize if the user is the event's creator
        if (empty(auth()->user()) || auth()->user()->id !== $event->user_id) {
            return false;
        }

        return true;
    }
}
