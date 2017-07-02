<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Ben Sampson',
                'email' => 'ben@pingalamedia.co.uk',
                'password' => bcrypt('pingala123'),
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Kamrul ahmed',
                'email' => 'kamrul@pingalamedia.co.uk',
                'password' => bcrypt('pingala123'),
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
