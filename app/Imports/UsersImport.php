<?php

namespace App\Imports;

use App\Models\User;
use Faker\Provider\Uuid;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'pronouns' => $row['pronouns'],
            'language' => $row['language'] ?? 'en',
            'school' => $row['school'],
            'engsoc_pos' => $row['engsoc_pos'],
            'program' => $row['discipline'],
            'linkedin' => $row['linkedin'],
            'is_active' => false,
            'is_admin' => false,
            'password' => Hash::make(Uuid::uuid()),
            'remember_token' => Str::random(10)
        ]);
    }
}
