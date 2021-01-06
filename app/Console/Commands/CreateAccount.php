<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Provider\Uuid;
use Hash;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CreateAccount extends Command
{
    protected $signature = 'make:user {email} {password} {--admin}';

    protected $description = 'Create a new user account';

    public function handle()
    {
        $user = User::create([
            'name' => "John Doe",
            'email' => $this->argument('email'),
            'email_verified_at' => now(),
            'password' => Hash::make($this->argument('password')), // password
            'remember_token' => Str::random(10),
            'discord_registration_id' => Uuid::uuid(),
            'is_active' => true,
            'is_admin' => $this->option('admin')
        ]);
    }
}
