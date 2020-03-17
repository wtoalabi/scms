<?php

namespace App\Platform\Contacts;

use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;
use App\Platform\Groups\Group;

class Contact extends BaseModel {
    use CustomQuery;
    protected $casts = [
        'birthday' => 'array'
    ];

    public function groups() {
        return $this->belongsToMany(Group::class,'contacts_groups');
    }
}

