<?php

namespace App\Infra\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetRequestIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->header('X-REQUEST-ID');
        if (empty($requestId)) {
            $requestId = Str::uuid()->toString();
        }
        $request->headers->set('X-REQUEST-ID', $requestId);
        $response = $next($request);
        $response->headers->set('X-REQUEST-ID', $requestId);

        return $response;
    }
}
