<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['is_published' => $this->has('is_published')]);
    }

    public function rules()
    {
        return [
            'is_published' => ['boolean'],
            'session_stream_id' => ['integer', 'exists:session_streams,id'],
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'start' => ['date', 'date_format:Y-m-d\TH:i'],
            'end' => ['date', 'date_format:Y-m-d\TH:i']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
