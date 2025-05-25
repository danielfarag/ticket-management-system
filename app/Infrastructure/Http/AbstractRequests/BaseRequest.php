<?php

namespace App\Infrastructure\Http\AbstractRequests;

use Illuminate\Foundation\Http\FormRequest as Request;

class BaseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * toaseter
     *
     * @param $validator
     * @return void
     */
    public function withValidator($validator)
    {
        session()->flash('message', ['type'=>'error', 'message'=> 'Fix validation errors and try again']);
        
        return $validator->errors()->all();
    }

}
