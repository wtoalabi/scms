<?php

namespace App\Platform\Admin\Authorizations\Policies;

use App\Platform\Accounts\Users\User;
use App\Platform\Base\BasePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesPolicies extends BasePolicy
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
    public function create() {
        return $this->hasPermissionTo('ADD_ROLE');
    }
    public function update() {
        return $this->hasPermissionTo('UPDATE_ROLE');
    }
    
    public function delete() {
        return $this->hasPermissionTo('DELETE_ROLE');
    }
    
}
