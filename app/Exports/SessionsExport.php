<?php

namespace App\Exports;

use App\Models\Session;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SessionsExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Session::all();
    }
}
