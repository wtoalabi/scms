<?php

namespace App\Platform\Contacts;

use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;
use App\Platform\Groups\Group;
use App\Platform\Phones\Phone;

class Contact extends BaseModel {
    use CustomQuery;
    protected $casts = [
        'birthday' => 'array'
    ];

    public function groups() {
        return $this->belongsToMany(Group::class,'contacts_groups')->withPivot(['default']);
    }

    public function defaultGroup() {
        return $this->groups()->wherePivot('default', true)->first();
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function defaultPhone() {
        return $this->phones->where('default', true)->first();
    }
}

