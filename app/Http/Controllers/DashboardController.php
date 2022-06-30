<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            return $this->admin();
        }

        $data['title'] = 'Dashboard | ' . config('app.name');
        $data['events'] = $user->events;

        return view('pages.dashboard', $data);
    }

    /**
     * Go to dashboard admin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function admin()
    {
        $data['title'] = 'Dashboard Admin | ' . config('app.name');
        $data['users'] = \App\Models\User::all()->sortBy('name');

        return view('pages.dashboard-admin', $data);
    }
}
