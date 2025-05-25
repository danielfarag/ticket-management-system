<?php

namespace App\Domain\Interaction\Http\Requests\Announcement;

use App\Domain\Interaction\Entities\Announcement;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class AnnouncementStoreFormRequest extends FormRequest implements AnnouncementFormRequest
{
    /**
     * Determine if the Announcement is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Announcement::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'in'            => ['required', 'in:dashboard,website'],
            'content'       => ['required', 'string', 'max:255'],
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
            'in'        =>  __('main.in'),
            'content'   =>  __('main.content'),
        ];
    }
}
