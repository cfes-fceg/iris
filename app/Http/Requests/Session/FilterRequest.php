<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'stream' => ['nullable', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
