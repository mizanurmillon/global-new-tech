<?php
namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {

        $teamData = [
            [
                'name'     => 'John Anderson',
                'position' => 'CEO & Founder',
                'image'    => '/uploads/team/members/team1.png',
            ],
            [
                'name'     => 'Emma Williams',
                'position' => 'CTO',
                'image'    => '/uploads/team/members/team2.png',
            ],
            [
                'name'     => 'David Lee',
                'position' => 'Head of Operations',
                'image'    => '/uploads/team/members/team3.png',
            ],
            [
                'name'     => 'Sofia Martinez',
                'position' => 'Head of Development',
                'image'    => '/uploads/team/members/team4.png',
            ],
        ];

        TeamMember::insert($teamData);

    }
}
