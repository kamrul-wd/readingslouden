<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Master',
                'slug' => 'master',
                'description' => 'Master Admin on CMS',
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Admin on CMS',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Normal user with no CMS permissions',
            ],
        ]);

        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
        ]);
    }
}