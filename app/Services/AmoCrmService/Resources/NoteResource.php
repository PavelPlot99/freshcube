<?php

namespace App\Services\AmoCrmService\Resources;

use App\Services\AmoCrmService\Concerns\BaseMethods;

class NoteResource
{
    use BaseMethods;

    private $baseUrl;

    public function __construct($service, $entity)
    {
        $this->service = $service;
        $this->baseUrl = "/api/v4/{$entity}/notes";
    }

}