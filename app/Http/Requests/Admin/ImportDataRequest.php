<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            'users' => ['file', 'nullable'],
            'sessions' => ['file', 'nullable'],
            'streams' => ['file', 'nullable'],
            'snl' => ['file', 'nullable']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
