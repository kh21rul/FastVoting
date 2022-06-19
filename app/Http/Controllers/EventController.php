<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventModifyRequest;
use App\Mail\VotingInvitation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard');
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
        return redirect()->route('dashboard')->with('error', 'Delete event feature is coming soon.');

        // TODO: Delete all entity that related to this event.
        // ...

        // TODO: Delete this event
        // ...

        // TODO: Redirect to Detail Event page if failed
        // if ($event == 0) {
        //     return redirect()->route('events.show', ['event' => $event])->with('error', 'Failed to delete this event.');
        // }

        // TODO: Redirect to Dashboard page if success
        // return redirect()->route('dashboard')->with('success', 'One event has been deleted.');
    }

    /**
     * Commit the event
     */
    public function commit($id)
    {
        $event = Event::find($id);

        // Check if all commit checklist is fulfilled.
        if (!$event->isAllCommitChecklistFulfilled()) {
            return redirect()->route('events.show', ['event' => $event])->with('error', 'There are requirement that not fulfilled yet.');
        }

        // Commit the event
        $event->is_committed = true;
        $event->save();

        // Send voting invitation email to all voters
        $failedDelivery = 0;

        foreach ($event->voters as $voter) {
            $sentMessage = Mail::to($voter->email)->send(new VotingInvitation($voter));

            if (!isset($sentMessage)) {
                $failedDelivery += 1;
            }
        }

        if ($failedDelivery > 0) {
            return redirect()->route('events.show', ['event' => $event])->with('error', 'Failed sending email to ' . $failedDelivery . ' voters.');
        }

        return redirect()->route('events.show', ['event' => $event])->with('success', 'Voting invitation email has been sent to all voters.');
    }
}
