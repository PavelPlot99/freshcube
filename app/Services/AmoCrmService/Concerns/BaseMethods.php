<?php

namespace App\Services\AmoCrmService\Concerns;

trait BaseMethods
{
    private $service;
    public function __construct($service) {
        $this->service = $service;
    }

    public function list(int $limit = 50, int $page = 1, array $additions = [], int $timeout = 50)
    {
        $url = $this->baseUrl;
        $payload = ['limit' => $limit, 'page' => $page];

        return $this->service->get(
            $this->service->buildRequestWithTokenAuth(),
            $url,
            array_merge($additions, $payload),
            $timeout
        );
    }

    public function post(array $payload): array
    {
        return $this->service->post(
            $this->service->buildRequestWithTokenAuth(),
            $this->baseUrl,
            $payload
        );
    }

}
