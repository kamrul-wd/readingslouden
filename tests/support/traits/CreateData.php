<?php

use App\Models\User;
use App\Models\Page;
use App\Models\Setting;
use App\Models\CompanyDetail;

trait CreateData {

    protected function createTestAccount()
    {
        $credentials = ['email' => 'ben@pingalamedia.co.uk', 'password' => 'pingala123'];

        return factory(User::class)->create($credentials);
    }

    protected function createSettings($amount = 5, array $override = [])
    {
        return factory(Setting::class, $amount)->create($override);
    }

    protected function createUser(array $overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    protected function createPages($amount = 5, array $overrides = [])
    {
        return factory(Page::class, $amount)->create($overrides);
    }

    protected function createCompanyDetails($amount = 5, array $overrides = [])
    {
        return factory(CompanyDetail::class, $amount)->create($overrides);
    }
}
