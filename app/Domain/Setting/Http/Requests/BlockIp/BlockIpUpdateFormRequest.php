<?php

namespace App\Domain\Setting\Http\Requests\BlockIp;

class BlockIpUpdateFormRequest extends BlockIpStoreFormRequest
{
    /**
     * Determine if the blockip is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('block_ip'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'ip_address'    => ['required','unique:block_ips,ip_address,'.$this->route('block_ip')->id.',id'],
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
