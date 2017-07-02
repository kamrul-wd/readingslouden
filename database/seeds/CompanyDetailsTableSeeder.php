<?php

use Illuminate\Database\Seeder;

class CompanyDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_details')->insert([
            'name' => 'Example Company',
            'email' => 'example@gmail.com',
            'address' => '234 The Road',
            'post_code' => 'ME5 8OW',
            'telephone_1' => '9876543210',
            'telephone_2' => '1234567890',
        ]);
    }
}
