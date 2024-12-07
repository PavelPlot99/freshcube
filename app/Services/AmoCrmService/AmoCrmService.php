<?php

namespace App\Services\AmoCrmService;

use App\Services\AmoCrmService\Concerns\CanSendPostRequest;
use App\Services\AmoCrmService\Resources\ContactResource;
use App\Services\AmoCrmService\Resources\LeadResource;
use App\Services\AmoCrmService\Concerns\BuildBaseRequest;
use App\Services\AmoCrmService\Concerns\CanSendGetRequest;
use App\Services\AmoCrmService\Resources\LinkResource;
use App\Services\AmoCrmService\Resources\NoteResource;

class AmoCrmService
{
    use BuildBaseRequest, CanSendGetRequest, CanSendPostRequest;

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

    public function note($entity): NoteResource
    {
        return new NoteResource($this, $entity);
    }

    public function link($entity, $entity_id): LinkResource
    {
        return new LinkResource($this, $entity, $entity_id);
    }
}