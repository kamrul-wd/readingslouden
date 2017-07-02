<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyRequest extends Request
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
                    'name' => 'required|max:255',
                    'address' => 'required|max:255',
                    'email' => 'required|email',
                    'post_code' => 'required|max:10',
                    'telephone_1' => 'required|max:255',
                    'telephone_2' => 'required|max:255',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:255',
                    'address' => 'required|max:255',
                    'email' => 'required|email',
                    'post_code' => 'required|max:10',
                    'telephone_1' => 'required|max:255',
                    'telephone_2' => 'required|max:255',
                ];
            default:
                break;
        }
    }
}
