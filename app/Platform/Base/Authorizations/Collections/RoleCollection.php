<?php

namespace App\Platform\Base\Authorization\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray($request) {
        return $this->collection->transform(function($role){
            return new RoleResource($role);
        });
    }
}
