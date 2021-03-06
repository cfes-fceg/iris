<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['is_admin' => $this->has('is_admin')]);
        $this->merge(['is_active' => $this->has('is_active')]);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['string', 'max:255'],
            'is_admin' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'discord_user_id' => ['nullable', 'integer'],
            'language' => ['nullable', 'string', 'max:10'],
            'school' => ['nullable', 'string', 'max:255'],
            'engsoc_pos' => ['nullable', 'string', 'max:255'],
            'program' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'snl_id' => ['nullable', 'integer']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
