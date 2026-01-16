<?php

namespace App\Infra\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Helpers\Utils;
use Closure;
use Illuminate\Http\Request;

class ApiKeyAuthMiddleware {
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if (blank($apiKey) || $apiKey !== (string) Utils::base64Decode(config('app.api_key'))) {
            throw new UnauthorizedException('Unauthorized: Invalid API Key');
        }

        return $next($request);
    }
}
