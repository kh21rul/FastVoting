<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoterPostRequest;
use App\Models\Event;
use App\Models\Voter;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Require authentication and email verification
        $this->middleware(['auth', 'verified']);

        // Authorize all actions.
        $this->authorizeResource(Voter::class, 'voter');

        // Ensure if event is editable to create new voter.
        $this->middleware('event.editable')->only(['create', 'store']);
    }

    /**
     * Display a listing of the voter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Event $event)
    {
        $data['title'] = 'Voters | ' . config('app.name');
        $data['event'] = $event;

        return view('pages.voters', $data);
    }

    /**
     * Show the form for creating a new voter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created voter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function store(VoterPostRequest $request, Event $event)
    {
        // Validate the request.
        $validatedData = $request->validated();
        $validatedData['event_id'] = $event->id;

        // Create a new voter.
        $voter = Voter::create($validatedData);

        if (empty($voter)) {
            return redirect()->route('events.voters.index', ['event' => $event])
                ->with('error', 'Failed adding new voter.');
        }

        // Generate token.
        $voter->token = \Illuminate\Support\Str::random(100);
        $voter->save();

        return redirect()->route('events.voters.index', ['event' => $event]);
    }

    /**
     * Display the specified voter.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified voter.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Voter $voter)
    {
        //
    }

    /**
     * Update the specified voter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voter $voter)
    {
        //
    }

    /**
     * Remove the specified voter from storage.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voter $voter)
    {
        // Delete the voter.
        if (! $voter->delete()) {
            return redirect()->route('events.voters.index', ['event' => $voter->event])
                ->with('error', 'Failed deleting the voter.');
        }

        return redirect()->route('events.voters.index', ['event' => $voter->event]);
    }
}
