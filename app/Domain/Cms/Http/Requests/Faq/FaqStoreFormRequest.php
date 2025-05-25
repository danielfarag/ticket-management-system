<?php

namespace App\Domain\Cms\Http\Requests\Faq;

use App\Domain\Cms\Entities\Faq;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class FaqStoreFormRequest extends FormRequest implements FaqFormRequest
{
    /**
     * Determine if the Faq is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Faq::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'question'          => ['required', 'string', 'max:255'],
            'answer'            => ['required', 'string', 'max:255'],
            'department_id'     => ['required', 'exists:departments,id'],
            'article_id'        => ['nullable', 'exists:articles,id'],
            'status'            => ['required', 'in:active,inactive'],
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
            'question'       =>  __('main.question'),
            'answer'         =>  __('main.answer'),
            'department_id'  =>  __('main.department'),
            'article_id'     =>  __('main.article'),
            'status'         =>  __('main.status'),
        ];
    }
}
