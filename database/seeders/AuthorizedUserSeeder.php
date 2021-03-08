<?php

namespace Database\Seeders;

use App\Models\AuthorizedUser;
use Illuminate\Database\Seeder;

class AuthorizedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthorizedUser::make(['email' => 'authorized@email.com'])->save();
    }
}
