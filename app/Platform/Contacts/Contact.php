<?php

namespace App\Platform\Contacts;

use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;

class Contact extends BaseModel {
    use CustomQuery;
    protected $casts = [
        'birthday' => 'array'
    ];
    /*
    11=> 11,
    21 => 12,
    12 => 21,
    1/3
    1/4,
    1/5,


     * */
}

