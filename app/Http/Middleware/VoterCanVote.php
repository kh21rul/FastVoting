<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VoterCanVote
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
        $voter = \App\Models\Voter::find($request->voterId);
        $toResultPage = redirect()->route('vote.result', ['voterId' => $voter->id, 'token' => $voter->token]);

        // Check if the event is already closed
        if ($voter->event->finished_at->isPast()) {
            // Redirect to the result page
            return $toResultPage->with('error', 'The vote has been closed.');
        }

        // Check if the voter has already voted
        if (isset($voter->ballot)) {
            // Redirect to the result page
            return $toResultPage->with('error', 'You have already voted.');
        }

        return $next($request);
    }
}
