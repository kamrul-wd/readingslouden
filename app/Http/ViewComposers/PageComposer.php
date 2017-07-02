<?php

namespace App\Http\ViewComposers;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Frontend\LayoutController;

class PageComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $view->with(
            'root_pages',
            ['' => 'Select Page'] + Page::root()
                ->descendantsAndSelf()
                ->limitDepth(1)
                ->lists('heading', 'id')
            ->all()
        );

        $view->with(
            'template_list',
            ['' => '[Default Template]'] + $this->templateList()
        );
    }

    protected function templateList()
    {
        $class = new \ReflectionClass(LayoutController::class);
        $methods = $class->getMethods();
        $template_list = [];

        foreach ($methods as $method) {
            if ($method->class == 'App\\Http\\Controllers\\Frontend\\LayoutController'
                && $method->name != '__construct'
            ) {
                $template_list[$method->name] = ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', $method->name));
            }
        }

        return $template_list;
    }
}
