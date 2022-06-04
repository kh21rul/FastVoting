<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoterPostRequest;
use App\Models\Event;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoterController extends Controller
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
     * Go to voters page
     */
    public function index($eventId)
    {
        $data['title'] = 'Voters | '. config('app.name');
        $data['event'] = Event::find($eventId);

        return view('pages.voters', $data);
    }

    /**
     * Create new voter
     */
    public function create(VoterPostRequest $request, $eventId)
    {
        // Validate the request.
        $validatedData = $request->validated();
        $validatedData['event_id'] = $eventId;

        // Create a new voter.
        $voter = Voter::create($validatedData);

        if (!isset($voter)) {
            return redirect()->back()->with('error', 'Failed adding new voter.');
        }

        // Generate token.
        $voter->token = Str::random(100);
        $voter->save();

        return redirect()->route('voters', ['id' => $eventId]);
    }
}
