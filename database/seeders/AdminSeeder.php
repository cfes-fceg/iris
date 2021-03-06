<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory( 1)->create([
            'email' => 'admin@example.com',
            'name' => 'Admin User',
            'is_admin' => true
//            'roles' => [UserRole::ROLE_ADMIN]
        ]);
    }
}
