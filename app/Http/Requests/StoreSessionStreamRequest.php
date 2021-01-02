<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionStreamRequest extends FormRequest
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
