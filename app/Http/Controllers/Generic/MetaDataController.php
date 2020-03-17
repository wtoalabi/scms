<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Platform\Base\Helpers\Authenticated;
use App\Platform\Contacts\Resources\ContactCollection;
use App\Platform\Groups\Group;
use Illuminate\Http\Request;

class MetaDataController extends Controller{
    public function index() {
        $id = Authenticated::LimitToID();
        $groups = Group::where('user_id', $id)->get();
        $data = [
            'groups'=> $groups->map(function($group){
                return [
                    'id' => $group->id,
                    'name' => $group->name
                ];
            })
        ];
        return response(['response'=>$data],200);
    }
}
