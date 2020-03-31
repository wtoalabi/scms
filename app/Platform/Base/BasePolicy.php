<?php

  namespace App\Platform\Base;

  use App\Platform\Base\Helpers\Authenticated;
  use Illuminate\Auth\Access\HandlesAuthorization;

  class BasePolicy
  {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
      //
    }

    public function before() {
      if(auth('admin')->check()){
        if(auth('admin')->user()->isSuper()){
          return true;
        }
      }
    }

    public function hasPermissionTo($permittedAction) {
      return Authenticated::User()->permissions()->contains($permittedAction);
    }

    public function isTheVerifiedOwnerWith($ownerID) {
      if (Authenticated::User()->id === intval($ownerID) || auth('admin')->check()) {
        return true;
      }
      return false;
    }
  }
