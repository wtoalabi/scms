<?php

namespace App\Platform\Base\Authorization;

use App\Platform\Accounts\Admins\Admin;
use App\Platform\Accounts\Merchants\Merchant;
use App\Platform\Accounts\Users\User;
use App\Platform\Base\BaseModel;
use App\Platform\Base\Helpers\Collections\CustomQuery;

class Role extends BaseModel {
    use CustomQuery;
    protected $withCount =['users','admins','permissions'];
    protected $fillable = ['title','description'];
    protected $casts = [
        'isCore' => 'bool'
    ];
  public function users() {
    return $this->morphedByMany(User::class, 'account','account_roles');
  }
  public function admins() {
    return $this->morphedByMany(Admin::class, 'account','account_roles');
  }
  public function permissions() {
    return $this->belongsToMany(Permission::class,'role_permissions');
  }
}
