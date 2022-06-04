<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:8', 'max:255'],
            'description' => ['nullable', 'string'],
            'started_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
        ]);
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:8', 'max:255'],
            'description' => ['nullable', 'string'],
            'started_at' => ['nullable', 'date', 'after:now', 'required_with:finished_at'],
            'finished_at' => ['nullable', 'date', 'after:started_at', 'required_with:started_at'],
        ]);

        $event = Event::find($id);
        $event->update($validatedData);

        return redirect()->route('event.detail', ['id' => $event->id]);
    }
}
