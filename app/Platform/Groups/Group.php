<?php

    namespace App\Platform\Groups;

    use App\Platform\Contacts\Contact;
    use Illuminate\Database\Eloquent\Model;

    class Group extends Model{
        public function contacts() {
            return $this->belongsToMany(Contact::class,'contacts_groups');
        }
    }
