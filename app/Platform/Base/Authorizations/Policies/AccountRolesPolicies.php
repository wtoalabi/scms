<?php

namespace App\Platform\Admin\Authorizations\Policies;

use App\Platform\Accounts\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountRolesPolicies
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
}
