<?php

namespace App\Domain\Interaction\Http\Requests\Mail;

use Carbon\Carbon;
use App\Domain\Interaction\Entities\Mail;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class MailStoreFormRequest extends FormRequest implements MailFormRequest
{
    /**
     * Determine if the Mail is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Mail::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email'      => ['required', 'array'],
            'email.*'    => ['required', 'email'],
            'subject'    => ['required', 'string', 'max:255'],
            'body'       => ['required', 'string'],
            'status'     => ['required', 'in:pending,sent,cancelled'],
            'send_at'    => ['required', 'date', 'after:now'],
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
            'email'       =>  __('main.email'),
            'subject'     =>  __('main.subject'),
            'body'        =>  __('main.body'),
            'status'      =>  __('main.status'),
            'send_at'     =>  __('main.send_at'),
        ];
    }
    
    /**
     * Get Validated attributes.
     *
     * @return array
     */
    public function validated()
    {
        $data = parent::validated();

        return array_merge(parent::validated(), [
            'email'       =>  join(',', $data['email']),
            'send_at'     =>  Carbon::parse($data['send_at']),
        ]);
    }
}
