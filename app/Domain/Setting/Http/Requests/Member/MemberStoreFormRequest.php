<?php

namespace App\Domain\Setting\Http\Requests\Member;

use App\Domain\Setting\Entities\Member;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class MemberStoreFormRequest extends FormRequest implements MemberFormRequest
{
    /**
     * Determine if the Member is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Member::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'           => ['required', 'string', 'max:255'],
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string', 'max:255'],
            'image'          => ['required', 'image']
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
        return [
            'name'          =>  __('main.name'),
            'title'         =>  __('main.title'),
            'description'   =>  __('main.description'),
        ];
    }
}
