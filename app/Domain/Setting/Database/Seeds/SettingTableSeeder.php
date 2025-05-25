<?php

namespace App\Domain\Setting\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Domain\Setting\Entities\Setting;
use App\Domain\Ticket\Entities\Severity;
use App\Domain\Ticket\Entities\Status;
use Faker\Factory;

class SettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $keys = [
            'name'                         => $faker->words(2, true),
            'email'                        => $faker->email(),
            'phone_number'                 => $faker->phoneNumber(),
            'working_hours'                => 'Mon-Fri 10-22',
            'keywords'                     => str_replace(' ', '|', $faker->sentence()),
            'description'                  => $faker->sentences(3,true),
            'default_status'               => Status::all()->random()->id,
            'default_severity'             => Severity::all()->random()->id,

            'footer_about'                 => $faker->paragraphs(5, true),
            'copyrights'                   => 'Supporter 2021 Powered BY domain',
            'address'                      => $faker->address,
            'show_address'                 => true,
            'show_quick_links'             => true,
            'show_about'                   => true,
            'show_social_networks'         => true,

            'facebook_url'                 => 'https://www.facebook.com/fb',
            'linkedin_url'                 => 'https://www.linkedin.com/fb',
            'twitter_url'                  => 'https://www.twitter.com/fb',
            'instagram_url'                => 'https://www.instagram.com/fb',

            'terms_conditions'             => $faker->paragraphs(20, true),
            'about'                        => $faker->paragraphs(20, true),
            'privacy_policy'               => $faker->paragraphs(20, true),
            
            'emails_notify'                => join('|', [$faker->email, $faker->email, $faker->email]),
            'sent_mail_ticket_created'     => true,
            'user_can_delete_ticket'       => true,

            'show_slider'                  => true,
            'show_search'                  => true,
            'show_departments'             => true,
            'show_submit_ticket'           => true,
            'show_faq'                     => true,
            'show_help'                    => true,
        ];

        $index = 0;
        foreach ($keys as $key => $value) {
            $settings[$index]['key'] = $key;
            $settings[$index++]['value'] = $value;
        }

        Setting::insert($settings);
    }
}
