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
            'zoom_meeting_id' => ['integer', 'required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
