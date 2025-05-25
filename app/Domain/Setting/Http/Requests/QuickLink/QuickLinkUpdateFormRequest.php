<?php

namespace App\Domain\Setting\Http\Requests\QuickLink;

class QuickLinkUpdateFormRequest extends QuickLinkStoreFormRequest
{
    /**
     * Determine if the quicklink is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('quick_link'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'priority'    => ['required','unique:quick_links,priority,'.$this->route('quick_link')->id.',id'],
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
