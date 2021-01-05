<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'stream' => ['nullable', 'integer'],
            'date' => ['nullable', 'date', 'date_format:Y-m-d'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
