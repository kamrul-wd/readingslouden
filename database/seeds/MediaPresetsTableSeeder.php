<?php

use Illuminate\Database\Seeder;

class MediaPresetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media_presets')->insert(
            [
                [
                    'name' => 'In-line Images',
                    'width' => 0,
                    'height' => 0,
                ],
                [
                    'name' => 'Banners',
                    'width' => 1000,
                    'height' => 400,
                ],
                [
                    'name' => 'News',
                    'width' => 250,
                    'height' => 250,
                ],
                [
                    'name' => 'Team',
                    'width' => 250,
                    'height' => 250,
                ],
            ]
        );
    }
}
