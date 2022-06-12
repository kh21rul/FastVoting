<?php

namespace App\Http\Middleware;

use App\Models\Voter;
use Closure;
use Illuminate\Http\Request;

class VoteAuthorization
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
        // Get voter detail from database
        $voter = Voter::find($request->voterId);

        // Check if voter exists
        if (!$voter) {
            abort(404, 'Voter not found');
        }

        // Check if token is valid
        if ($voter->token !== $request->token) {
            abort(401, 'Token is invalid');
        }

        // Check if voter has voted
        if ($voter->ballot) {
            // Redirect to result page
            return redirect()->route('result', ['event' => $voter->event, 'token' => $voter->token])->with('success', 'You have already voted.');
        }

        // Check if the vote is not closed yet
        if ($voter->event->finished_at->isPast()) {
            // Redirect to result page
            return redirect()->route('result', ['event' => $voter->event, 'token' => $voter->token])->with('error', 'The vote has been closed.');
        }

        return $next($request);
    }
}
