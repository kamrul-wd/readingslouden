<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontPageTest extends TestCase
{
    use DatabaseMigrations, CreateData;

    /** @test */
    public function we_can_see_the_frontend_as_a_guest()
    {
        $pages = $this->createPages(5);
        $this->createCompanyDetails(1);

        $this->visit('/')
             ->see($pages->first()->pluck('heading'))
        ;
    }
}
