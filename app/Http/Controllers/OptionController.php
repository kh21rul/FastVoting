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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
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
     * @param string $name The image name.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getImage($name)
    {
        $option = Option::where('image_location', $name)->first();

        if (empty($option)) {
            abort(404);
        }

        // Verify if the user is authorized to get the image.
        if ($option->event->creator->id !== auth()->user()->id) {
            abort(403);
        }

        $path = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

        if (!file_exists($path)) {
            abort(404, 'Image may have been moved or deleted');
        }

        return response()->file($path);
    }
}
