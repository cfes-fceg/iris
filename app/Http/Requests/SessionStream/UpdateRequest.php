<?php

namespace App\Http\Requests\SessionStream;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['string', 'max:100'],
            'description' => ['string'],
            'zoom_meeting_id' => ['integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
