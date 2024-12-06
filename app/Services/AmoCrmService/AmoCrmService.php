<?php

namespace App\Services\AmoCrmService;

use App\Services\AmoCrmService\Resources\ContactResource;
use App\Services\AmoCrmService\Resources\LeadResource;
use App\Services\AmoCrmService\Concerns\BuildBaseRequest;
use App\Services\AmoCrmService\Concerns\CanSendGetRequest;

class AmoCrmService
{
    use BuildBaseRequest, CanSendGetRequest;

        private $baseUrl;
        private $token;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    public function lead(): LeadResource
    {
        return new LeadResource($this);
    }

    public function contact(): ContactResource
    {
        return new ContactResource($this);
    }
}