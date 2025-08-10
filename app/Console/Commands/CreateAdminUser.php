<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('role', 'admin')->first();
        
        if ($user) {
            $user->update([
                'email' => 'elmoumen221133@elmoumen.com',
                'password' => Hash::make('Elmoumen119237@@'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
            $this->info('Admin user updated successfully!');
        } else {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'elmoumen221133@elmoumen.com',
                'password' => Hash::make('Elmoumen119237@@'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
            $this->info('Admin user created successfully!');
        }

        $this->info('Email: elmoumen221133@elmoumen.com');
        $this->info('Password: Elmoumen119237@@');
    }
}
