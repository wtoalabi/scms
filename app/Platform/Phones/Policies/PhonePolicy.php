<?php

namespace App\Platform\Phones\Policies;
use App\Platform\Phones\Phone;
use App\Platform\Base\BasePolicy;

class PhonePolicy extends BasePolicy
{

    public function create() {
      if ($this->hasPermissionTo('ADD_PHONE')) {
          return true;
      }
    }

    public function view() {
         return $this->hasPermissionTo('VIEW_PHONE');
        }

    public function update (){
         $phone = Phone::find(request()->all()['id']);
         if ($this->hasPermissionTo('UPDATE_PHONE')) {
           /*if($this->isTheVerifiedOwnerWith($phone)){
                return true;
           }*/
         }
    }

    public function delete (){
        $phone = Phone::find(request()->all()['id']);
         if ($this->hasPermissionTo('DELETE_PHONE')) {
           /*if($this->isTheVerifiedOwnerWith($phone)){
                 return true;
            }*/
         }
    }
}