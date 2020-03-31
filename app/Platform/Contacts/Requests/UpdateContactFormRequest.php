<?php

    namespace App\Platform\Contacts\Requests;

    use App\Platform\Base\BaseFormRequest;

    class UpdateContactFormRequest extends BaseFormRequest
    {

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'address' => 'required|string',
                'selectedGroups' => 'nullable|array',
                'phones' => 'nullable|array',
                'dateAdded' => 'nullable',
                'birthday' => 'nullable'
            ];
        }
    }
