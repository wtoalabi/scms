<?php

namespace App\Platform\Admin\Authorizations\Requests\Roles;

use App\Platform\Base\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends BaseFormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'title' => 'required|unique:roles|max:255',
                'description' => 'required'
        ];
    }
}
