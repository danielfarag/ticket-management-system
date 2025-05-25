<?php

namespace App\Domain\User\Http\Requests\Auth;

use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class UserForgetFormRequest extends FormRequest
{
    /**
     * Determine if the User is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     =>  ['required', 'email', 'exists:users,email'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email'        =>  __('main.email'),
        ];
    }
}
