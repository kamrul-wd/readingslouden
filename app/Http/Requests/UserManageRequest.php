<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserManageRequest extends Request
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
                    'name' => 'required|max:30',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    'active' => '',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:30',
                    'email' => 'required|email',
                    'password' => 'min:6',
                    'active' => '',
                ];
            default:
                break;
        }
    }
}
