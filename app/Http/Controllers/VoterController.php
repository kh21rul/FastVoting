<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
}
