<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'heading' => 'required|max:255',
                    'excerpt' => '',
                    'content' => 'required',
                    'slug' => 'required|unique_slug:create_add,'.$this->parent_id ?: null,
                    'browser_title' => 'max:255',
                    'description' => 'max:200',
                    'robots' => 'max:100',
                    'canonical' => 'url|max:255',
                    'footer_code' => '',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'heading' => 'required|max:255',
                    'excerpt' => '',
                    'content' => 'required',
                    'slug' => 'required|unique_slug:update,'.$this->pages,
                    'browser_title' => 'max:255',
                    'description' => 'max:200',
                    'robots' => 'max:100',
                    'canonical' => 'url|max:255',
                    'footer_code' => '',
                ];
            default:
                break;
        }
    }
}
