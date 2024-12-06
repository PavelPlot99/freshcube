<?php

namespace App\Services\AmoCrmService\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    public function buildRequestWithTokenAuth(): PendingRequest
    {
        return $this->withBaseUrl()->withToken($this->token);
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }
}
