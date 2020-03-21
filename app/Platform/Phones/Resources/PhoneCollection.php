<?php

namespace App\Platform\Phones\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneCollection extends ResourceCollection
{

    public function toArray($request)
    {
      return $this->collection->transform(function($phone){
        return new PhoneResource($phone);
      });
    }
}
