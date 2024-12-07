<?php

namespace App\Http\Resources\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
        ];
    }
}
