<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionPostRequest;
use App\Models\Event;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OptionController extends Controller
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
     * Go to add new option page
     */
    public function add($eventId)
    {
        $data['title'] = 'Add New Option | ' . config('app.name');
        $data['event'] = Event::find($eventId);

        return view('pages.option-add', $data);
    }

    /**
     * Create new option
     */
    public function create(OptionPostRequest $request, $eventId)
    {
        $validatedData = $request->validated();
        $validatedData['event_id'] = $eventId;

        // Create a new option.
        $option = Option::create($validatedData);

        if (!isset($option)) {
            return redirect()->back()->with('error', 'Failed creating new option.');
        }

        // TODO: Upload image.
        // ...

        return redirect()->route('event.detail', ['id' => $eventId]);
    }
}
