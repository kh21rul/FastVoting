<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventModifyRequest;
use App\Mail\VotingInvitation;
use App\Models\Event;
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
        //
    }

    /**
     * Go to add new event page
     */
    public function add()
    {
        $data['title'] = 'Add new event | '. config('app.name');
        return view('pages.event-add', $data);
    }

    /**
     * Create new event
     */
    public function create(EventModifyRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;

        // Create a new event.
        $event = Event::create($validatedData);

        if (!isset($event)) {
            return redirect()->back()->with('error', 'Failed creating new event.');
        }

        return redirect()->route('event.detail', ['id' => $event->id]);
    }

    /**
     * Go to detail event page
     */
    public function detail($id)
    {
        $data['title'] = 'Event detail | '. config('app.name');
        $data['event'] = Event::find($id);

        return view('pages.event-detail', $data);
    }

    /**
     * Go to list event page
     */
    public function edit($id)
    {
        $data['title'] = 'Edit event | '. config('app.name');
        $data['event'] = Event::find($id);

        return view('pages.event-edit', $data);
    }

    /**
     * Update the event
     */
    public function update(EventModifyRequest $request, $id)
    {
        $validatedData = $request->validated();

        $event = Event::find($id);
        $event->update($validatedData);

        return redirect()->route('event.detail', ['id' => $event->id]);
    }

    /**
     * Delete the event
     */
    public function delete($id)
    {
        return redirect()->route('dashboard')->with('error', 'Delete event feature is coming soon.');

        $event = Event::find($id);

        // TODO: Delete all entity that related to this event.
        // ...

        // TODO: Delete this event
        // ...

        // TODO: Redirect to Detail Event page if failed
        // if ($event == 0) {
        //     return redirect()->route('event.detail', ['id' => $id])->with('error', 'Failed to delete this event.');
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
            return redirect()->route('event.detail', ['id' => $id])->with('error', 'There are requirement that not fulfilled yet.');
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
            return redirect()->route('event.detail', ['id' => $id])->with('error', 'Failed sending email to ' . $failedDelivery . ' voters.');
        }

        return redirect()->route('event.detail', ['id' => $id])->with('success', 'Voting invitation email has been sent to all voters.');
    }
}
