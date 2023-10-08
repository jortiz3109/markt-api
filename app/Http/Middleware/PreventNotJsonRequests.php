<?php

namespace App\Http\Middleware;

use App\Exceptions\NotJsonRequestException;
use Closure;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventNotJsonRequests
{
    /**
     * The URIs that should be excluded from request header verification.
     *
     * @var array<string>
     */
    protected array $except = [];

    /**
     * Handle an incoming request.
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        throw_if(
            condition: $this->validateCondition($request),
            exception: NotJsonRequestException::class
        );

        return $next($request);
    }

    private function validateCondition(Request $request): bool
    {
        return !in_array($request->route()->uri(), $this->except)
            && !$request->expectsJson();
    }
}
