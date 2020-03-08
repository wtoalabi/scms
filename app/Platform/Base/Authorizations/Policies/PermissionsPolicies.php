<?php
    
    namespace App\Platform\Admin\Authorizations\Policies;
    
    use App\Platform\Accounts\Users\User;
    use App\Platform\Base\Authorization\Role;
    use App\Platform\Base\BasePolicy;
    use App\Platform\Base\Helpers\Authenticated;
    use Illuminate\Auth\Access\HandlesAuthorization;
    
    class PermissionsPolicies extends BasePolicy
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
        
        public function update() {
            $user = Authenticated::User();
            $role = Role::find(request('role_id'));
            if (class_basename($user) !== "Admin" || $role->title === "Super Admin") {
                return false;
            } else {
                return $this->hasPermissionTo('UPDATE_PERMISSION');
            }
        }
    }
