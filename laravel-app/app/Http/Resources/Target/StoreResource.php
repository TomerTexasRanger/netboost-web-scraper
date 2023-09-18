<?php

namespace App\Http\Resources\Target;

use App\Http\Resources\Link\IndexResource;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @mixin Target
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title' => $this->title,
            'links' => IndexResource::collection($this->links),
            'created_at' => $this->created_at,
        ];
    }
}
