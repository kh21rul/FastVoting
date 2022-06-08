<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionPostRequest;
use App\Models\Event;
use App\Models\Option;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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

        // Upload image.
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() .'_' . $image->hashName();
            $path = $image->storeAs($this->imageStoragePath, $imageName);

            if (!isset($path)) {
                return redirect()->back()->with('error', 'Failed uploading image.')->withInput();
            }

            $option->image_location = $imageName;
            $option->save();
        }

        return redirect()->route('event.detail', ['id' => $eventId]);
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

        if (!isset($option)) {
            throw new NotFoundHttpException();
        }

        // Verify if the user is authorized to get the image.
        if ($option->event->creator != auth()->user()) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        $path = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

        if (!file_exists($path)) {
            throw new NotFoundHttpException('Image may have been moved or deleted');
        }

        return response()->file($path);
    }
}
