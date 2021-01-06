<?php

namespace App\Http\Requests\SessionStream;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['string', 'max:100', 'required'],
            'description' => ['string'],
            'zoom_host' => ['email', 'nullable', 'unique:session_streams,zoom_host'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
