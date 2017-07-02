<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MediaDeleteRequest extends Request
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
        switch (\Route::currentRouteName()) {
            case 'admin.media.delete':
                return [
                    'media_files' => 'required|array|exists:media,id',
                ];
            default:
                break;
        }
    }
}
