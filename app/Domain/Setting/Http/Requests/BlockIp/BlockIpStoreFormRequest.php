<?php

namespace App\Domain\Setting\Http\Requests\BlockIp;

use App\Domain\Setting\Entities\BlockIp;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class BlockIpStoreFormRequest extends FormRequest implements BlockIpFormRequest
{
    /**
     * Determine if the BlockIp is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', BlockIp::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'ip_address'    => ['required', 'unique:block_ips'],
            'reason'        => ['required'],
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
    /**
     * Get validated attributes.
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(),[
            'blocker_id'     =>  auth()->id()
        ]);
    }

    
}
