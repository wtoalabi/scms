<?php

namespace App\Platform\Contacts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
        ];
    }
}
