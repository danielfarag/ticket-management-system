<?php

namespace App\Domain\User\Http\Requests\Auth;

use App\Domain\User\Http\Requests\User\UserStoreFormRequest;

class UserUpdateFormRequest extends UserStoreFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('user', auth()->user()));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => ['required', 'min:3', 'max:255'],
            'email'         => ['required', 'unique:users,email,'.auth()->id().',id'],
            'phone_number'  => ['required', 'unique:users,phone_number,'.auth()->id().',id'],
        ];

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return parent::attributes();
    }
}
