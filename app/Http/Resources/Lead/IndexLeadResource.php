<?php

namespace App\Http\Resources\Lead;

use App\Http\Resources\Contact\IndexContactResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexLeadResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at->toDateTimeString(),
            'contacts' => IndexContactResource::collection($this->contacts)
        ];
    }
}
