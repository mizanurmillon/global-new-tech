<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {

        $teamData = [
            [
                'name'              => 'John Anderson',
                'email'             => 'john@globalnewtech.com',
                'password'          => bcrypt('12345678'),
                'position'          => 'CEO & Founder',
                'avatar_path'       => '/uploads/team/members/team1.png',
                'role'              => 'team',
                'is_active'         => true,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Emma Williams',
                'email'             => 'emma.williams@globalnewtech.com',
                'password'          => bcrypt('12345678'),
                'position'          => 'CTO',
                'avatar_path'       => '/uploads/team/members/team2.png',
                'role'              => 'team',
                'is_active'         => true,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'David Lee',
                'email'             => 'david.lee@globalnewtech.com',
                'password'          => bcrypt('12345678'),
                'position'          => 'Head of Operations',
                'avatar_path'       => '/uploads/team/members/team3.png',
                'role'              => 'team',
                'is_active'         => true,
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Sofia Martinez',
                'email'             => 'sofia.martinez@globalnewtech.com',
                'password'          => bcrypt('12345678'),
                'position'          => 'Head of Development',
                'avatar_path'       => '/uploads/team/members/team4.png',
                'role'              => 'team',
                'is_active'         => true,
                'email_verified_at' => now(),
            ],
        ];

        User::insert($teamData);

    }
}
