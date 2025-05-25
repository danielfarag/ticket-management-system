<?php

namespace App\Domain\Setting\Exports;

use Illuminate\Support\Collection;
use App\Domain\Setting\Entities\Setting;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Domain\Setting\Repositories\Contracts\SettingRepository;

class SettingExport implements FromCollection
{
    /**
     * Reference Model
     *
     * @var Setting
     */
    protected $model = Setting::class;

    /**
     * Is Dummy
     *
     * @var boolean
     */
    protected $dummy = false;

    /**
     * Dummy
     *
     * @var Object
     */
    protected $faker = null;

    /**
     * Settings data
     *
     * @var array
     */
    protected $keys = [];


    /**
     * Set dummy
     *
     * @param boolean $dummy
     */
    public function __construct($dummy = false)
    {
        $this->dummy = $dummy;
        $this->faker = \Faker\Factory::create();
        $this->settingRepository = app()->make(SettingRepository::class);
    }


    public function collection()
    {
        if($this->dummy){
            $data = [
                [ 'key',                              'value' ],

                [ 'name',                             $this->faker->words(4, true) ],
                [ 'email',                            $this->faker->email ],
                [ 'phone_number',                     $this->faker->phoneNumber ],
                [ 'working_hours',                    'Mon-Fri 10-22' ],
                [ 'keywords',                         str_replace(' ', '|', $this->faker->sentence()) ],
                [ 'description',                      $this->faker->sentence() ],
                [ 'default_status',                   $this->faker->word() ],
                [ 'default_severity',                 $this->faker->word() ],

                

                [ 'footer_about',                     $this->faker->paragraphs(6, true) ],
                [ 'copyrights',                       $this->faker->paragraph() ],
                [ 'address',                          $this->faker->streetAddress ],
                [ 'show_address',                     $this->faker->boolean() ],
                [ 'show_quick_links',                 $this->faker->boolean() ],
                [ 'show_about',                       $this->faker->boolean() ],
                [ 'show_social_networks',             $this->faker->boolean() ],
                


                [ 'facebook_url',                     'https://www.facebook.com/website' ],
                [ 'twitter_url',                      'https://www.twitter.com/website' ],
                [ 'linkedin_url',                     'https://www.linkedin.com/website' ],
                [ 'instagram_url',                    'https://www.instagram.com/website' ],


                [ 'terms_conditions',                 $this->faker->paragraphs(6, true) ],
                [ 'about',                            $this->faker->paragraphs(6, true) ],
                [ 'privacy_policy',                   $this->faker->paragraphs(6, true) ],


                [ 'emails_notify',                    join('|', [$this->faker->email, $this->faker->email]) ],
                [ 'sent_mail_ticket_created',         $this->faker->boolean() ],
                [ 'user_can_delete_ticket',           $this->faker->boolean() ],

                
                [ 'show_slider',                      $this->faker->boolean() ],
                [ 'show_search',                      $this->faker->boolean() ],
                [ 'show_departments',                 $this->faker->boolean() ],
                [ 'show_submit_ticket',               $this->faker->boolean() ],
                [ 'show_faq',                         $this->faker->boolean() ],
                [ 'show_help',                        $this->faker->boolean() ],

            ];
        }else{
            $data = [
                [ 'key', 'value' ],
            ];
            $this->settingRepository->all()->map(function($setting) use(&$data){
                array_push($data, [ $setting->key, $setting->value]);
            });
        }
        return new Collection([
            $data,
        ]);
    }
}