<?php

namespace App\Domain\General\Http\Requests\Slider;

use App\Domain\General\Entities\Slider;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class SliderStoreFormRequest extends FormRequest implements SliderFormRequest
{
    /**
     * Determine if the Slider is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Slider::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'subtitle'  =>   ['required', 'min:3', 'max:255'],
            'title'     =>   ['required', 'min:3', 'max:255'],
            'button'    =>   ['required', 'min:3', 'max:255'],
            'link'      =>   ['required', 'string', 'url'],
            'status'    =>   ['required', 'in:active,inactive'],
            'image'     =>   ['required', 'image']
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
