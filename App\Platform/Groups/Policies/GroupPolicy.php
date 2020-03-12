<?php

namespace App\Platform\Groups\Policies;
use App\Platform\Groups\Group;
use App\Platform\Base\BasePolicy;

class GroupPolicy extends BasePolicy
{

    public function create() {
      if ($this->hasPermissionTo('ADD_GROUP')) {
          return true;
      }
    }

    public function view() {
         return $this->hasPermissionTo('VIEW_GROUP');
        }

    public function update (){
         $group = Group::find(request()->all()['id']);
         if ($this->hasPermissionTo('UPDATE_GROUP')) {
           /*if($this->isTheVerifiedOwnerWith($group)){
                return true;
           }*/
         }
    }

    public function delete (){
        $group = Group::find(request()->all()['id']);
         if ($this->hasPermissionTo('DELETE_GROUP')) {
           /*if($this->isTheVerifiedOwnerWith($group)){
                 return true;
            }*/
         }
    }
}