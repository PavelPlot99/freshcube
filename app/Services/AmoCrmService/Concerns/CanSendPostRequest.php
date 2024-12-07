<?php

namespace App\Services\AmoCrmService\Concerns;

use Illuminate\Http\Client\PendingRequest;

trait CanSendPostRequest
{
    public function post(PendingRequest $request, string $url, array $payload = []): array
    {
        return $request->post($url, $payload)->json();
    }
}
