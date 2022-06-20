<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyVoterToken
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
        if (empty($request->voterId) || empty($request->token)) {
            abort(400, 'Voter ID or token is missing');
        }

        // Get voter detail from database
        $voter = \App\Models\Voter::find($request->voterId);

        // Check if voter exists
        if (empty($voter)) {
            abort(404, 'Voter not found');
        }

        // Check if token is valid
        if ($voter->token !== $request->token) {
            abort(401, 'Token is invalid');
        }

        return $next($request);
    }
}
