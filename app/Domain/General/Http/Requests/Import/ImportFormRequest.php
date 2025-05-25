<?php

namespace App\Domain\General\Http\Requests\Import;

use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class ImportFormRequest extends FormRequest 
{
    /**
     * Determine if the Import is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = [
            'articles',
            'faqs',
            'todos',
            'categories',
            'services',
            'sliders',
            'announcements',
            'contacts',
            'mails',
            'mail_templates',
            'block_ips',
            'quick_links',
            'settings',
            'departments',
            'escalations',
            'notes',
            'severities',
            'statuses',
            'surveys',
            'tickets',
            'roles',
            'users',
            'members'
        ];
        
        $rules = [
            'file'  =>  ['required', 'mimes:xlsx'],
            'type'  =>  ['required', 'in:'.join(',',$types)]
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
            'file'        =>  __('main.file'),
            'type'        =>  __('main.type'),
        ];
    }
}
