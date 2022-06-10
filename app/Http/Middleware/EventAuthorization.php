<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;

class EventAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get event detail from database
        $event = Event::find($request->route('id'));

        // Check if the event is exist.
        if ($event == null) {
            return redirect()->route('dashboard')->with('error', 'The event you were looking for could not be found.');
        }

        // Check if the event belongs to the user
        if ($event->creator != auth()->user()) {
            return redirect()->route('dashboard')->with('error', 'You are not allowed to access this event.');
        }

        return $next($request);
    }
}
