<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin User
            [
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'phone'             => '01521539767',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'is_active'         => true,
                'email_verified_at' => now(),
                'term_accept'       => true,
            ],

            [
                'name'              => 'Rahat',
                'email'             => 'sv.rahat99@gmail.com',
                'phone'             => '01521539767',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'is_active'         => true,
                'email_verified_at' => now(),
                'term_accept'       => true,
            ],

            // Normal User
            [
                'name'              => 'User',
                'email'             => 'user@user.com',
                'phone'             => '01712345679',
                'password'          => Hash::make('12345678'),
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => now(),
                'term_accept'       => true,
            ],

            [
                'name'              => 'Rahat',
                'email'             => 'rahatul.ice.09.pust@gmail.com',
                'phone'             => '01712345681',
                'password'          => Hash::make('12345678'),
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => now(),
                'term_accept'       => true,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
