<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge(['is_published' => $this->has('is_published')]);
    }

    public function rules()
    {
        return [
            'is_published' => ['boolean'],
            'session_stream_id' => ['nullable', 'integer', 'exists:session_streams,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'start' => ['date', 'date_format:Y-m-d\TH:i', 'required'],
            'end' => ['date', 'date_format:Y-m-d\TH:i', 'required']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
