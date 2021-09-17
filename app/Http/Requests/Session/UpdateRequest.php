<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['is_published' => $this->has('is_published')]);
        $this->merge(['sync_zoom_meeting' => $this->has('sync_zoom_meeting')]);
    }

    public function rules()
    {
        return [
            'is_published' => ['boolean'],
            'sync_zoom_meeting' => ['boolean'],
            'session_stream_id' => ['nullable', 'integer', 'exists:session_streams,id'],
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'start' => ['date', 'date_format:Y-m-d\TH:i'],
            'end' => ['date', 'date_format:Y-m-d\TH:i'],
            'zoom_meeting_id' => ['nullable','integer']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
