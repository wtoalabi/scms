<?php

namespace App\Platform\Contacts;

use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;
use App\Platform\Groups\Group;
use App\Platform\Phones\Phone;

class Contact extends BaseModel {
    use CustomQuery;
    protected $casts = [
        'birthday' => 'array',
    ];

    protected $fillable = ['first_name','last_name','email','birthday','dateAdded','address'];
    public function groups() {
        return $this->belongsToMany(Group::class,'contacts_groups');
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function defaultPhone() {
        $default = $this->phones->where('default', true)->first();
        if(!$default && count($this->phones)>0){
            $default = $this->phones->first();
            $default->update(['default'=>true]);
        }
        return $default;
    }

    public function defaultGroup() {
        if($this->groups->count()>0){
            return $this->groups->random();
        }else{
            return null;
        }
    }

    public function getDateAddedAttribute($value) {
        return intval($value);
    }
}
