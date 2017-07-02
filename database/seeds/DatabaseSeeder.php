<?php

use App\Models\User;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call(RoleTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(MediaPresetsTableSeeder::class);
        $this->call(CompanyDetailsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SettingTableSeeder::class);

        Page::rebuild();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Model::reguard();
    }
}
