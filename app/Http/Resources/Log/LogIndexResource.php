<?php

namespace App\Http\Resources\Log;

use Illuminate\Http\Resources\Json\JsonResource;

class LogIndexResource extends JsonResource
{
    public function toArray($request)
    {
        $lead = $this->properties['lead'];
        $name = $this->properties['name'];

        return [
            'text' => "Контакт: {$name} привязан к сделке: {$lead}",
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}