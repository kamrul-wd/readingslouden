<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminSettingTest extends TestCase
{
    use DatabaseMigrations, CreateData;

    /** @test */
    public function can_see_all_settings()
    {
        $user = $this->createTestAccount();

        $settings = $this->createSettings(5);

        $this->actingAs($user)
            ->visit(route('admin.settings.index'))
            ->seePageIs(route('admin.settings.index'))
            ->see($settings[2]->label)
            ->see($settings[2]->name)
            ->see($settings[2]->value)
        ;
    }

    /** @test */
    public function can_add_a_setting()
    {
        $user = $this->createTestAccount();

        $this->actingAs($user)
             ->visit(route('admin.settings.create'))
             ->type('Test Setting', 'label')
             ->type('test_setting', 'name')
             ->type('a_value', 'value')
             ->press('Submit')
             ->seeInDatabase('settings', [
                 'label' => 'Test Setting',
                 'name' => 'test_setting',
                 'value' => 'a_value',
             ])
        ;
    }

    /** @test */
    public function can_edit_a_setting()
    {
        $user = $this->createTestAccount();

        $this->createSettings(5);

        $this->actingAs($user)
             ->visit(route('admin.settings.edit', 2))
             ->type('Edited Setting', 'label')
             ->type('edited_setting', 'name')
             ->type('edited_value', 'value')
             ->press('Submit')
             ->seeInDatabase('settings', [
                 'label' => 'Edited Setting',
                 'name' => 'edited_setting',
                 'value' => 'edited_value',
             ])
        ;
    }

    /** @test */
    public function can_delete_a_setting()
    {
        $user = $this->createTestAccount();

        $settings = $this->createSettings(5);

        $this->actingAs($user)
             ->delete(route('admin.settings.destroy', 3))
             ->dontSeeInDatabase('settings', [
                 'label' => $settings[2]->label,
                 'name' => $settings[2]->name,
                 'value' => $settings[2]->value,
             ])
        ;
    }
}
