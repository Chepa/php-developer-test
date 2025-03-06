<?php

namespace App\Http\Resourses;

use App\Models\Apartment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Apartment $resource */
class SearchResultResource extends JsonResource
{

    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return array_merge($this->resource->toArray(), [
            'price' => number_format($this->resource->price),
        ]);
    }
}
