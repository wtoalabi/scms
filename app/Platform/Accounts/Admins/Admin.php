<?php

namespace App\Platform\Accounts\Admins;

use App\Platform\Accounts\Permissible;
use App\Platform\Accounts\Recordable;
use App\Platform\Base\Exceptions\NotAuthorizedException;
use App\Platform\Base\Helpers\Collections\CustomQuery;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Admin extends Authenticatable
{
  use Notifiable, Permissible, Recordable, CustomQuery;
  protected $casts = [
    'email_verified_at' => 'datetime',
    'approved' => 'boolean'
  ];

  protected $fillable = [
    'name', 'email', 'password','profile_image','approved'
  ];

  public function isSuper() {
    return $this->isSuper && $this->role()->first()->id == 1;
  }
    public function profile_image() {
      $basePath = "media/admins";
      if($this->profile_image){
          $path = "$basePath/$this->profile_image";
      }else{
          $path = "$basePath/default-thumb.png";
      }

        return asset(Storage::url($path));
    }
}
