<?php

namespace App\Platform\Contacts\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactCollection extends ResourceCollection
{

    public function toArray($request)
    {
      return $this->collection->transform(function($contact){
        return new ContactResource($contact);
      });
    }
}
