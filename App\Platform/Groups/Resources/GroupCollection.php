<?php

namespace App\Platform\Groups\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
{

    public function toArray($request)
    {
      return $this->collection->transform(function($group){
        return new GroupResource($group);
      });
    }
}
