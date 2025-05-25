<?php

namespace App\Domain\Interaction\Http\Requests\MailTemplate;

use App\Domain\Interaction\Entities\MailTemplate;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;
use App\Domain\Interaction\Repositories\Eloquent\MailTemplateRepositoryEloquent;

class MailTemplateStoreFormRequest extends FormRequest implements MailTemplateFormRequest
{
    /**
     * Determine if the MailTemplate is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', MailTemplate::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type'     => ['required', 'string', 'in:'.join(',', array_keys(MailTemplateRepositoryEloquent::$templates))],
            'subject'  => ['required', 'string', 'max:255'],
            'body'     => ['required', 'string'],
            'default'  => ['required', 'boolean'],
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
            'name'        =>  __('main.name'),
        ];
    }
}
