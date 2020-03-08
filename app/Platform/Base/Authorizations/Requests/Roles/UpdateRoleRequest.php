<?php

namespace App\Platform\Admin\Authorizations\Requests\Roles;

use App\Platform\Base\Authorization\Role;
use App\Platform\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends BaseFormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $role = Role::where('title', request('title'))->first();
        return [
            'title' => 'required',
            $role ? Rule::unique('title')->ignore($role->title): '',
            'description' => 'required'
        ];
    }
}
