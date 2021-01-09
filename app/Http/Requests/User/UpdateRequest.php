<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['is_admin' => $this->has('is_admin')]);
        $this->merge(['is_active' => $this->has('is_active')]);
    }

    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'max:255', 'unique:users,email,' . $this->user()->id],
            'password' => ['string', 'max:255', 'min:8', 'confirmed'],
            'language' => ['nullable', 'string', 'max:10'],
            'school' => ['nullable', 'string', 'max:255'],
            'engsoc_pos' => ['nullable', 'string', 'max:255'],
            'program' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
