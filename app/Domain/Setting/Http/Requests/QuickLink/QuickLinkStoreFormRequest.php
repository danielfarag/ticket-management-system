<?php

namespace App\Domain\Setting\Http\Requests\QuickLink;

use App\Domain\Setting\Entities\QuickLink;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class QuickLinkStoreFormRequest extends FormRequest implements QuickLinkFormRequest
{
    /**
     * Determine if the QuickLink is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', QuickLink::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'     => ['required', 'string', 'max:255'],
            'url'       => ['required', 'url'],
            'priority'  => ['required','numeric', 'unique:quick_links,priority'],
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
            'title'       =>  __('main.title'),
            'url'         =>  __('main.url'),
            'priority'    =>  __('main.priority'),
        ];
    }
}
