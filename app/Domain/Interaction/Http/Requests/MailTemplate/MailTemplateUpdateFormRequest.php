<?php

namespace App\Domain\Interaction\Http\Requests\MailTemplate;

class MailTemplateUpdateFormRequest extends MailTemplateStoreFormRequest
{
    /**
     * Determine if the mailtemplate is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('mail_template'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            //
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
