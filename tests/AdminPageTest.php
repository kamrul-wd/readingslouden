<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminPageTest extends TestCase
{
    use DatabaseMigrations, CreateData;

    /** @test */
    public function can_toggle_active_state_of_a_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(5);

        $this->actingAs($user)
            ->post(route('admin.pages.toggle-active'), ['id' => 2])
            ->seeJson([
                'error' => false,
            ])
        ;
    }

    /** @test */
    public function can_reorder_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(5);

        $this->actingAs($user)
            ->post(route('admin.pages.re-order'), ['id' => 3, 'left_sibling_id' => 1])
            ->seeJson([
                'error' => false,
            ])
        ;
    }

    /** @test */
    public function can_add_a_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(2);

        $this->actingAs($user)
            ->visit(route('admin.pages.create'))
            ->type('About Us Test', 'heading')
            ->type('about-us', 'slug')
            ->type('Example of the excerpt field', 'excerpt')
            ->type('Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'content')
            ->type('<p>footer.code</p>', 'footer_code')
            ->type('Browser Title Here', 'browser_title')
            ->type('http://example.com/some/uri/segment', 'canonical')
            ->check('active')
            ->press('Submit')
            ->seeInDatabase('pages', ['heading' => 'About Us Test'])
            ->seeInDatabase('page_extras', ['browser_title' => 'Browser Title Here'])
        ;
    }

    /** @test */
    public function can_add_a_sub_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(2);

        $this->actingAs($user)
            ->visit(route('admin.pages.add', 2))
            ->type('Test Sub Page', 'heading')
            ->type('test-sub-page', 'slug')
            ->type('Example of the excerpt field', 'excerpt')
            ->type('Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'content')
            ->check('active')
            ->press('Submit')
            ->seeInDatabase('pages', ['parent_id' => 2, 'heading' => 'Test Sub Page'])
        ;
    }

    /** @test */
    public function can_edit_a_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(3);

        $this->actingAs($user)
            ->visit(route('admin.pages.edit', 2))
            ->type('Test Edited Heading', 'heading')
            ->type('test-edited-heading', 'slug')
            ->type('Some Edited Title', 'browser_title')
            ->type('SEO Edited Description', 'description')
            ->press('Submit')
            ->seeInDatabase('pages', ['heading' => 'Test Edited Heading'])
            ->seeInDatabase('page_extras', ['browser_title' => 'Some Edited Title'])
            ->seeInDatabase('page_metas', ['description' => 'SEO Edited Description'])
        ;
    }

    /** @test */
    public function can_copy_a_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(3, ['heading' => 'About Us']);

        $this->actingAs($user)
            ->post(route('admin.pages.copy', 2))
            ->seeInDatabase('pages', ['heading' => 'About Us [Copy]'])
        ;
    }

    /** @test */
    public function can_move_a_page()
    {
        $user = $this->createTestAccount();

        $this->createPages(2);
        $this->createPages(1, ['heading' => 'Test Move']);
        $this->createPages(5, ['parent_id' => 2]);

        $this->actingAs($user)
            ->post(route('admin.pages.move', 3), ['new_parent' => 2])
            ->seeInDatabase('pages', ['parent_id' => 2, 'heading' => 'Test Move'])
        ;
    }

    /** @test */
    public function can_delete_a_page()
    {
        $user = $this->createTestAccount();

        $pages = $this->createPages(5);

        $this->actingAs($user)
            ->delete(route('admin.pages.destroy', 3))
            ->dontseeInDatabase('pages', [
                'heading' => $pages[2]->heading,
                'slug' => $pages[2]->slug,
            ])
        ;
    }
}
