<?php

namespace App\Domain\User\Http\Requests\Auth;

use App\Domain\User\Http\Rules\CurrentPasswordRule;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class UserUpdatePasswordFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        $rules = [
            "current_password"  => ['required', new CurrentPasswordRule],
            'password'          => ['required', 'min:8', 'max:32', 'confirmed'],
        ];

        return array_merge(parent::rules(), $rules);
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
