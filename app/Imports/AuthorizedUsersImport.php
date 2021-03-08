<?php

namespace App\Imports;

use App\Models\AuthorizedUser;
use Maatwebsite\Excel\Concerns\ToModel;

class AuthorizedUsersImport implements ToModel
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
