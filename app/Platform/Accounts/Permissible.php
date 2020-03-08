<?php
  /**
   * Created by Alabi Olawale
   * Date: 6/10/2019
   */
  declare(strict_types=1);

  namespace App\Platform\Accounts;


  use App\Platform\Base\Authorization\Permission;
  use App\Platform\Base\Authorization\Role;
  use App\Platform\Base\Exceptions\NotAuthorizedException;
  use App\Platform\Base\Helpers\Authenticated;

  trait Permissible
  {

    public function roles() {
      return $this->morphToMany(Role::class, 'account','account_roles');
    }

    public function role() {
      return $this->roles->first();
    }

    public function permissions (){
        if(Authenticated::User()->isSuper){
            return Permission::all()->pluck('ability');
        }else{
            return optional($this->role())->permissions->pluck('ability');
        }
    }

    public function check($action, $model) {
      $user = Authenticated::User();
      if ($user->can($action, $model)) {
        return true;
      }
      //throw new NotAuthorizedException("", 401);
      abort(401, "You are not permitted for this action");

    }
  }
