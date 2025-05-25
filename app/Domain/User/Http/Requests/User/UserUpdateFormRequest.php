<?php

namespace App\Domain\User\Http\Requests\User;

class UserUpdateFormRequest extends UserStoreFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email'         => ['required', 'unique:users,email,'.$this->route('user')->id.',id'],
            'phone_number'  => ['required', 'unique:users,phone_number,'.$this->route('user')->id.',id'],
            'password'      => ['nullable', 'min:8', 'max:32', 'confirmed'],
        ];

        return array_merge(parent::rules(), $rules);
    }
}
