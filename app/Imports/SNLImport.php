<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SNLImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::where('email', '=', $row['email'])->first();
            if (isset($user))
                $user->update(['snl_id' => $row['snl_id']]);
            else
                Log::warning("SNL group not assigned to email -> " . $row['email']);
        }
    }
}
