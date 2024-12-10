<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashPlainTextPasswords extends Command
{
    protected $signature = 'fix:hash-passwords';
    protected $description = 'Hash plain text passwords in the database';

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
           // Only rehash plain text
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("Hashed password for user: {$user->email}");

        }
        $this->info('All plain text passwords have been hashed.');
    }
}
