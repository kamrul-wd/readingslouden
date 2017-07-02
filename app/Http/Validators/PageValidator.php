<?php

namespace App\Http\Validators;

use App\Models\Page;
use Illuminate\Validation\Validator;

class PageValidator extends Validator
{
    public static $name = 'page';

    public function validatePageExists($attribute, $value, $parameters, $translators)
    {
        return false;
    }

    public function validateUniqueSlug($attribute, $value, $parameters, $translators)
    {
        // If home page, don't validate slug
        if ($parameters[0] == 'update' && $parameters[1] == 1 && $value == 'home_do_not_set') {
            return true;
        }

        if ($parameters[1]) {
            $currentPage = Page::find($parameters[1]);
        } else {
            $currentPage = Page::find(1);
        }

        if ($parameters[0] == 'create_add') {
            if (! Page::where('slug', $value)
                ->where('parent_id', $currentPage->id)
                ->exists()
            ) {
                return true;
            }
        } elseif ($parameters[0] == 'update') {
            if (! Page::where('slug', $value)
                ->where('parent_id', $currentPage->id)
                ->where('id', '!=', $currentPage->id)
                ->exists()
            ) {
                return true;
            }
        }

        return false;
    }
}
