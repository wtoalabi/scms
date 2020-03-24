<?php

namespace App\Platform\Phones;

use App\Platform\Contacts\Contact;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $casts = [
        'default' => 'boolean'
    ];
    public function contact() {
        return $this->belongsTo(Contact::class);
    }

}
