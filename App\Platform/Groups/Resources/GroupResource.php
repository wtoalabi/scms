<?php

namespace App\Platform\Groups\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
        ];
    }
}
