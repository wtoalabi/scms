<?php

namespace App\Platform\Base\Authorization\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'usersCount' => $this->users_count,
            'merchantsCount' => $this->merchants_count,
            'adminsCount' => $this->admins_count,
            'permissionsCount' => $this->permissions_count,
            'isCore' => $this->isCore
        ];
    }
}
