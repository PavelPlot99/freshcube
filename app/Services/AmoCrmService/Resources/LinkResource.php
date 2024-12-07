<?php

namespace App\Services\AmoCrmService\Resources;

use App\Services\AmoCrmService\Concerns\BaseMethods;

class LinkResource
{
    use BaseMethods;

    public $baseUrl;

    public function __construct($service, $entity, $entity_id)
    {
        $this->service = $service;
        $this->baseUrl = "/api/v4/{$entity}/{$entity_id}/link";
    }

}