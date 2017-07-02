<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingRequest extends Request
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
                    'label' => 'required|max:255|unique:settings,label',
                    'name' => 'required|max:255',
                    'value' => 'required|max:255',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'label' => 'required|max:255|unique:settings,label,'.$this->settings,
                    'name' => 'required|max:255',
                    'value' => 'required|max:255',
                ];
            default:
                break;
        }
    }
}
