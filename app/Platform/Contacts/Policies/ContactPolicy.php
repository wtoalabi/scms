<?php

namespace App\Platform\Contacts\Policies;
use App\Platform\Contacts\Contact;
use App\Platform\Base\BasePolicy;

class ContactPolicy extends BasePolicy
{

    public function create() {
      if ($this->hasPermissionTo('ADD_CONTACT')) {
          return true;
      }
    }

    public function view() {
         return $this->hasPermissionTo('VIEW_CONTACT');
        }

    public function update (){
         $contact = Contact::find(request()->all()['id']);
         if ($this->hasPermissionTo('UPDATE_CONTACT')) {
           if($this->isTheVerifiedOwnerWith($contact->id)){
                return true;
           }
         }
    }

    public function delete ($user,$contact){
         if ($this->hasPermissionTo('DELETE_CONTACT')) {
           if($this->isTheVerifiedOwnerWith($contact->user_id)){
                 return true;
            }
         }
    }
}
