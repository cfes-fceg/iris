<?php

namespace App\Imports;

use App\Models\AuthorizedUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthorizedUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return AuthorizedUser
     */
    public function model(array $row)
    {
        return new AuthorizedUser([
            'email' => $row['email']
        ]);
    }
}
