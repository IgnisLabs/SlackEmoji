<?php

namespace App\Http\Middleware;

use Closure;

class SlackTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->tokenIsValid($request->get('token'))) {
            return response('', 401)->header('Content-type', 'text/plain');
        }

        return $next($request);
    }

    private function tokenIsValid($token)
    {
        $validTokens = explode(',', getenv('SLACK_SLASH_TOKENS'));

        return in_array($token, $validTokens);
    }
}
