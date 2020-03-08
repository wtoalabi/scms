<?php

namespace App\Platform\Accounts\Users;

use App\Platform\Accounts\Permissible;
use App\Platform\Base\Helpers\Collections\CustomQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Platform\Accounts\Recordable;
class User extends Authenticatable{
    use Recordable, Permissible, CustomQuery;
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
        'approved' => 'boolean'
    ];
    protected $fillable = ['email','address','phone','companyName','password','approved'];

}
