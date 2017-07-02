<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MediaPresetsRequest extends Request
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
                    'name' => 'required|max:50|unique:media_presets,name,'.$this->presets,
                    'height' => 'required|numeric',
                    'width' => 'required|numeric',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:50|unique:media_presets,name,'.$this->presets,
                    'height' => 'required|numeric',
                    'width' => 'required|numeric',
                ];
            default:
                break;
        }
    }
}
