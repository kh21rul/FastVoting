<?php

namespace App\Http\Controllers;

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
     * Go to detail event page
     */
    public function detail($id)
    {
        // TODO: Get event detail from database
        // ...

        return view('pages.event-detail');
    }
}
