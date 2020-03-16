<?php

namespace idempotency;

use Closure;
use Illuminate\Support\Facades\Cache;

class IdempotencyMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Grab method and key
        $method = $request->getMethod();
        $key = $request->header(config('idempotency.key'));

        // Check if is an allowed idempotency request
        if (!$this->isIdempotentRequest($method, $key)) {
            return $next($request);
        }

        // Check if is cached and return
        if ($this->isCached($key, $request)) {
            return Cache::get("idempotency:{$key}:response");
        }

        // Execute request and cache
        $response = $next($request);
        $response->header(config('idempotency.key'), $key);
        Cache::put("idempotency:{$key}:request", [
            "resource" => $request->path(),
            "params" => $request->all(),
        ], config('idempotency.ttl'));
        Cache::put("idempotency:{$key}:response", $response, config('idempotency.ttl'));
        return $response;
    }

    /**
     * @param string $method
     * @param string|null $key
     * @return bool
     */
    private function isIdempotentRequest($method, $key)
    {
        return (in_array($method, config('idempotency.IDEMPOTENT_METHODS')) && $key);
    }

    /**
     * @param string $key
     * @return bool
     */
    private function isCached($key, $request)
    {
        return Cache::has("idempotency:{$key}:request") && Cache::get("idempotency:{$key}:request") === [
                "resource" => $request->path(),
                "params" => $request->all(),
            ];
    }
}
