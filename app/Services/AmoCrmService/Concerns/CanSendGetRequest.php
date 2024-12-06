<?php

namespace App\Services\AmoCrmService\Concerns;

use Illuminate\Http\Client\{PendingRequest, Response};

trait CanSendGetRequest
{
    public function get(PendingRequest $request, string $url, array $payload = [], int $timeout = 50)
    {
        return $request->get($url, $payload)->json();
    }

    public function getClear(PendingRequest $request, string $url, array $payload = [], int $timeout = 50): Response
    {
        return $request->retry(3, 300)->timeout($timeout)->get($url, $payload);

    }
}
