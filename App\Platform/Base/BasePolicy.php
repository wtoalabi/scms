<?php
  
  namespace App\Platform\Base;
  
  use Illuminate\Auth\Access\HandlesAuthorization;
  
  class BasePolicy
  {
    use HandlesAuthorization;
    
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
      //
    }

    public function before(User $user){
      if(auth('admin')->check()){
          if(auth('admin')->user()->isSuper()){
            return true;
          }
        }
    }
    public function hasPermissionTo($permission) {
      return auth()->user()->permissions()->contains($permission);
    }

    public function isTheVerifiedOwnerOf(ownerID) {
          if (auth()->id() === intval($ownerID) || auth('admin')->check()) {
            return true;
          }
        }
    }