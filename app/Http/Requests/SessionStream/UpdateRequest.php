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
            'zoom_host' => ['email', 'nullable', 'unique:session_streams,zoom_host,' . $this->route('stream')->id],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
