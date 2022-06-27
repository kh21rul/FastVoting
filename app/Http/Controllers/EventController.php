<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventModifyRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
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
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user  The user who owns the event.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ?User $user = null)
    {
        // Authorize to see the user's event if the logged user is an admin.
        if (auth()->user()->is_admin && isset($user)) {
            $data['title'] = $user->name . '\'s Events | ' . config('app.name');
            $data['user'] = $user;
            $data['events'] = $user->events;

            // Return the Events Page view.
            return view('pages.dashboard', $data);
        }

        // Redirect to dashboard page
        return redirect()->route('dashboard')
            ->with('error', $request->session()->pull('error'))
            ->with('success', $request->session()->pull('success'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add new event | ' . config('app.name');
        return view('pages.event-add', $data);
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \App\Http\Requests\EventModifyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventModifyRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;

        // Create a new event.
        $event = Event::create($validatedData);

        if (!isset($event)) {
            return redirect()->back()->with('error', 'Failed creating new event.');
        }

        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Display the specified event.
     *
     * @param  \App\Models\Event $event The event to display.
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $data['title'] = 'Event detail | ' . config('app.name');
        $data['event'] = $event;

        return view('pages.event-detail', $data);
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  \App\Models\Event $event The event to edit.
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $data['title'] = 'Edit event | ' . config('app.name');
        $data['event'] = $event;

        return view('pages.event-edit', $data);
    }

    /**
     * Update the specified event in storage.
     *
     * @param  \App\Http\Requests\EventModifyRequest $request
     * @param  \App\Models\Event $event The event to edit.
     * @return \Illuminate\Http\Response
     */
    public function update(EventModifyRequest $request, Event $event)
    {
        $validatedData = $request->validated();

        $event->update($validatedData);

        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  \App\Models\Event $event The event to delete.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // Delete this event and return error message if failed.
        if (! $event->delete()) {
            return redirect()->back()->with('error', 'Failed deleting event.');
        }

        // Redirect to Dashboard page if success
        return redirect()->route('dashboard')->with('success', 'One event has been deleted.');
    }

    /**
     * Commit the event
     *
     * @param  \App\Models\Event $event The event to commit.
     */
    public function commit(Event $event)
    {
        // Check if all commit checklist is fulfilled.
        if (! $event->isAllCommitChecklistFulfilled()) {
            return redirect()->route('events.show', ['event' => $event])->with('error', 'There are requirement that not fulfilled yet.');
        }

        // Commit the event
        $event->is_committed = true;
        $event->save();

        // Send voting invitation email to all voters
        $failedDelivery = 0;

        foreach ($event->voters as $voter) {
            // Send voting invitation email to voter
            if (! $voter->sendInvitationEmail()) {
                $failedDelivery += 1;
            }
        }

        if ($failedDelivery > 0) {
            return redirect()->route('events.show', ['event' => $event])->with('error', 'Failed sending email to ' . $failedDelivery . ' voters.');
        }

        return redirect()->route('events.show', ['event' => $event])->with('success', 'Voting invitation email has been sent to all voters.');
    }
}
