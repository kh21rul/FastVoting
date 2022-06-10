<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;

class IsEventEditable
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

        // Ensure if the event is not committed yet.
        if ($event->is_committed) {
            return redirect()->route('event.detail', ['id' => $event->id])->with('error', 'Your event has been committed and can\'t be edited anymore.');
        }

        return $next($request);
    }
}
