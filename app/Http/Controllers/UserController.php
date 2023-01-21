<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Require authentication and email verification
        $this->middleware(['auth', 'verified']);

        // Authorize all actions.
        $this->authorizeResource(User::class, 'user');
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data['title'] = $user->name . ' | ' . config('app.name');
        $data['user'] = $user;

        return view('pages.user-detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user User to be deleted.
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete this event and return error message if failed.
        if (! $user->delete()) {
            return redirect()->back()->with('error', 'Failed deleting user.');
        }

        // Redirect to Dashboard page if success
        return redirect()->route('dashboard')->with('success', 'One user has been deleted.');
    }
}
