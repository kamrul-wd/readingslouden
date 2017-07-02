<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'label' => 'Google Analytics Code',
                'name' => 'ga_code',
                'value' => '',
                'advanced' => 1,
                'protected' => 1,
            ],
            [
                'label' => 'Web Master Tools ID',
                'name' => 'wmt_id',
                'value' => '',
                'advanced' => 1,
                'protected' => 1,
            ],
            [
                'label' => 'robots.txt Contents',
                'name' => 'robots_txt',
                'value' => 'User-agent: *
Disallow:
',
                'advanced' => 1,
                'protected' => 1,
            ],
            [
                'label' => 'Website Redirects',
                'name' => 'redirects',
                'value' => '',
                'advanced' => 1,
                'protected' => 1,
            ],
            [
                'label' => 'Facebook URL',
                'name' => 'social_facebook_url',
                'value' => 'https://www.facebook.com/PageName',
                'advanced' => 0,
                'protected' => 1,
            ],
            [
                'label' => 'Twitter URL',
                'name' => 'social_twitter_url',
                'value' => 'https://twitter.com/username',
                'advanced' => 0,
                'protected' => 1,
            ],
            [
                'label' => 'Google+ URL',
                'name' => 'social_google_plus_url',
                'value' => 'https://plus.google.com/+Name',
                'advanced' => 0,
                'protected' => 1,
            ],
            [
                'label' => 'YouTube URL',
                'name' => 'social_youtube_url',
                'value' => 'https://www.youtube.com/url',
                'advanced' => 0,
                'protected' => 1,
            ],
            [
                'label' => 'LinkedIn URL',
                'name' => 'social_linkedin_url',
                'value' => 'https://www.linkedin.com/in/Name-ID',
                'advanced' => 0,
                'protected' => 1,
            ],
            [
                'label' => 'Main Contact Email',
                'name' => 'email_main_contact',
                'value' => 'ben@pingalamedia.co.uk',
                'advanced' => 0,
                'protected' => 1,
            ]
        ]);
    }
}
