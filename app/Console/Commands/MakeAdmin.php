<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'make:admin {email : The admin account email}';

    protected $description = 'Create or promote an admin account';

    public function handle(): int
    {
        $email = strtolower($this->argument('email'));
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->forceFill(['is_admin' => true])->save();
            $this->info("Admin access enabled for {$email}.");

            return self::SUCCESS;
        }

        $name = $this->ask('Admin name');
        $password = $this->secret('Password (at least 12 characters)');

        if (strlen($password) < 12) {
            $this->error('The password must be at least 12 characters.');

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ]);

        $this->info("Admin account created for {$email}.");

        return self::SUCCESS;
    }
}
