<?php

namespace App\Domain\Setting\Http\Requests\Setting;

use App\Domain\Setting\Entities\Setting;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class SettingStoreFormRequest extends FormRequest
{
    /**
     * Determine if the Setting is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Setting::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'logo'                              => ['nullable', 'image'],
            'name'                              => ['required'],
            'email'                             => ['required'],
            'phone_number'                      => ['required'],
            'working_hours'                     => ['required'],
            'keywords'                          => ['required', 'array', 'min:1'],
            'description'                       => ['required'],
            
            'footer_logo'                       => ['nullable', 'image'],
            'copyrights'                        => ['required'],
            'address'                           => ['required'],
            'footer_about'                      => ['required'],
            'show_address'                      => ['required'],
            'show_quick_links'                  => ['required'],
            'show_about'                        => ['required'],
            'show_social_networks'              => ['required'],

            'show_slider'                       => ['required'],
            'show_search'                       => ['required'],
            'show_departments'                  => ['required'],
            'show_submit_ticket'                => ['required'],
            'show_faq'                          => ['required'],
            'show_help'                         => ['required'],
            'emails_notify'                     => ['required', 'array'],
            'sent_mail_ticket_created'          => ['required'],
            'user_can_delete_ticket'            => ['required'],


            'facebook_url'                      => ['nullable', 'url'],
            'twitter_url'                       => ['nullable', 'url'],
            'linkedin_url'                      => ['nullable', 'url'],
            'instagram_url'                     => ['nullable', 'url'],

            'terms_conditions'                  => ['required'],
            'about'                             => ['required'],
            'privacy_policy'                    => ['required'],

            'default_status'                    => ['required', 'exists:statuses,id'],
            'default_severity'                  => ['required', 'exists:severities,id'],

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
            'copyrights'                        => __('main.copyrights'),
            'address'                           => __('main.address'),
            'footer_about'                      => __('main.footer_about'),
            'show_address'                      => __('main.show_address'),
            'show_about'                        => __('main.show_about'),
            'show_quick_links'                  => __('main.show_quick_links'),
            'show_social_networks'              => __('main.show_social_networks'),
            'name'                              => __('main.name'),
            'email'                             => __('main.email'),
            'phone_number'                      => __('main.phone_number'),
            'working_hours'                     => __('main.working_hours'),
            'keywords'                          => __('main.keywords'),
            'description'                       => __('main.description'),
            'show_slider'                       => __('main.show_slider'),
            'show_search'                       => __('main.show_search'),
            'show_departments'                  => __('main.show_departments'),
            'show_submit_ticket'                => __('main.show_submit_ticket'),
            'show_faq'                          => __('main.show_faq'),
            'show_help'                         => __('main.show_help'),
            
            'emails_notify'                     => __('main.emails_notify'),
            'sent_mail_ticket_created'          => __('main.sent_mail_ticket_created'),
            'user_can_delete_ticket'            => __('main.user_can_delete_ticket'),

            'facebook_url'                      => __('main.facebook_url'),
            'twitter_url'                       => __('main.twitter_url'),
            'linkedin_url'                      => __('main.linkedin_url'),
            'instagram_url'                     => __('main.instagram_url'),
            'terms_conditions'                  => __('main.terms_conditions'),
            'about'                             => __('main.about'),
            'privacy_policy'                    => __('main.privacy_policy'),
            'default_status'                    => __('main.default_status'),
            'default_severity'                  => __('main.default_severity'),
        ];
    }

    /**
     * Get custom validated for validator errors.
     *
     * @return array
     */
    public function validated()
    {
        $validated = parent::validated();

        return array_merge($validated,[
            'keywords'          =>  join('|', $validated['keywords']),
            'emails_notify'     =>  join('|', $validated['emails_notify']),
        ]);
    }
}
