<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge(['is_published' => $this->has('is_published')]);
        $this->merge(['create_meeting' => $this->has('create_meeting')]);
    }

    public function rules()
    {
        return [
            'is_published' => ['boolean'],
            'create_meeting' => ['boolean'],
            'session_stream_id' => ['nullable', 'integer', 'exists:session_streams,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'start' => ['date', 'date_format:Y-m-d\TH:i', 'required'],
            'end' => ['date', 'date_format:Y-m-d\TH:i', 'required'],
            'zoom_meeting_id' => ['nullable','integer']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
