<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionPostRequest;
use App\Models\Event;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * The image storage path.
     *
     * @var string
     */
    private $imageStoragePath = 'private/images/options';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Require authentication and email verification
        $this->middleware(['auth', 'verified'])
            ->except(['getImage']);

        // Authorize all actions.
        $this->authorizeResource(Option::class, 'option');

        // Ensure if event is editable to create new option.
        $this->middleware('event.editable')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Event $event The event that the option belongs to.
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $data['title'] = 'Add New Option | ' . config('app.name');
        $data['event'] = $event;

        return view('pages.option-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OptionPostRequest $request The request that contains the option data.
     * @param  \App\Models\Event $event The event that the option belongs to.
     * @return \Illuminate\Http\Response
     */
    public function store(OptionPostRequest $request, Event $event)
    {
        $validatedData = $request->validated();
        $validatedData['event_id'] = $event->id;

        // Create a new option.
        $option = Option::create($validatedData);

        if (empty($option)) {
            return redirect()->back()->with('error', 'Failed creating new option.')->withInput();
        }

        // Upload image.
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->hashName();
            $path = $image->storeAs($this->imageStoragePath, $imageName);

            if (empty($path)) {
                return redirect()->back()->with('error', 'Failed uploading image.')->withInput();
            }

            $option->image_location = $imageName;
            $option->save();
        }

        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified option.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $data['title'] = 'Edit Option | ' . config('app.name');
        $data['option'] = $option;
        $data['event'] = $option->event;

        return view('pages.option-edit', $data);
    }

    /**
     * Update the specified option in storage.
     *
     * @param  \App\Http\Requests\OptionPostRequest $request The request that contains the option data.
     * @param  \App\Models\Option $option
     * @return \Illuminate\Http\Response
     */
    public function update(OptionPostRequest $request, Option $option)
    {
        $validatedData = $request->validated();

        // Check if there are any changes in the image.
        if ($request->hasFile('image')) {
            // Delete image old image if exists.
            if (isset($option->image_location)) {
                $imagePath = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Upload the new image.
            $image = $request->file('image');
            $imageName = time() . '_' . $image->hashName();
            $path = $image->storeAs($this->imageStoragePath, $imageName);

            if (empty($path)) {
                return redirect()->back()->with('error', 'Failed uploading image.')->withInput();
            }

            $option->image_location = $imageName;
        }

        // Update the option and return error message if failed.
        if (!$option->update($validatedData)) {
            return redirect()->back()->with('error', 'Failed updating option.')->withInput();
        }

        return redirect()->route('events.show', ['event' => $option->event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        // Delete the option image if it exists.
        if (isset($option->image_location)) {
            $imagePath = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the option and return error message if failed.
        if (!$option->delete()) {
            return redirect()->route('events.show', ['event' => $option->event])->with('error', 'Failed deleting option.');
        }

        return redirect()->route('events.show', ['event' => $option->event]);
    }

    /**
     * Get the option image.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Option $option The option that the image belongs to.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getImage(Request $request, Option $option)
    {
        // Verify if the user is authorized to get the image as the voter.
        if ($request->has('voterId') && $request->has('token')) {
            $voter = \App\Models\Voter::find($request->voterId);

            if (empty($voter)) {
                abort(404);
            }

            if ($voter->token !== $request->token) {
                abort(401, 'Token is invalid');
            }

            if ($voter->event->id !== $option->event->id) {
                abort(403, 'You don\'t have access to this event');
            }
        } else {
            // Verify if the user is authorized to get the image as the owner.
            if (empty(auth()->user()) || auth()->user()->id !== $option->event->user_id) {
                abort(403, 'You don\'t have access to this event');
            }
        }

        // Verify if the image exists.
        $path = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

        if (! file_exists($path)) {
            abort(404, 'Image may have been moved or deleted');
        }

        return response()->file($path);
    }
}
