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
            $imageName = time() . '_' . $image->hashName();
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

    public function delete($eventId, $optionId)
    {
        $option = Option::find($optionId);

        // If the option does not exist, return 404.
        if (!isset($option)) {
            return redirect()->route('event.detail', ['id' => $eventId])->with('error', 'The option that you are trying to delete does not exist.');
        }

        // Delete the option image if it exists.
        if (isset($option->image_location)) {
            $imagePath = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the option and return error message if failed.
        if (!$option->delete()) {
            return redirect()->route('event.detail', ['id' => $eventId])->with('error', 'Failed deleting option.');
        }

        return redirect()->route('event.detail', ['id' => $eventId]);
    }

    public function edit($eventId, $optionId)
    {
        $data['title'] = 'Edit Option | ' . config('app.name');
        $data['event'] = Event::find($eventId);
        $data['option'] = Option::find($optionId);

        return view('pages.option-edit', $data);
    }

    public function update(OptionPostRequest $request, $eventId, $optionId)
    {
        $validatedData = $request->validated();
        $validatedData['event_id'] = $eventId;

        // Update the option.
        $option = Option::find($optionId);

        if (!isset($option)) {
            return redirect()->back()->with('error', 'Failed updating option.');
        }

        // Check if there are any changes in the image.
        if ($request->hasFile('image')) {
            // Delete image old image if it exists.
            if (isset($option->image_location)) {
                $imagePath = storage_path('app/' . $this->imageStoragePath . '/' . $option->image_location);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $option->image_location = null;
            }

            // Upload image.
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->hashName();
                $path = $image->storeAs($this->imageStoragePath, $imageName);

                if (!isset($path)) {
                    return redirect()->back()->with('error', 'Failed uploading image.')->withInput();
                }

                $option->image_location = $imageName;
            }
        }


        if (!$option->update($validatedData)) {
            return redirect()->back()->with('error', 'Failed updating option.');
        }

        return redirect()->route('event.detail', ['id' => $eventId]);
    }
}
