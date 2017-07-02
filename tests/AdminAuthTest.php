<?php

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminAuthTest extends TestCase
{
    use DatabaseMigrations, CreateData, RegistersUsers, LoginUsers;

    /** @test */
    public function it_logs_a_user_in()
    {
        $this->createUser($credentials = ['email' => 'ben@pingalamedia.co.uk', 'password' => 'pingala123']);

        $this->login($credentials);
    }

    /** @test */
    public function it_notifies_a_user_of_incorrect_login()
    {
        $this->createUser($credentials = ['email' => 'foo@example.com', 'password' => 'fooexample']);

        $this->login($credentials)
            ->seePageIs(route('admin.auth.login'))
            ->see('These credentials do not match our records.')
        ;
    }

    /** @test */
    public function it_notifies_a_user_of_login_errors()
    {
        $this->createUser($credentials = ['email' => 'foo@example.com', 'password' => '']);

        $this->login($credentials)
            ->seePageIs(route('admin.auth.login'))
            ->see('The password field is required.')
        ;
    }

    /** @test */
    public function we_cant_see_admin_page_as_a_guest()
    {
        $this->visit('/admin')
            ->seePageIs(route('admin.auth.login'))
        ;
    }
}
