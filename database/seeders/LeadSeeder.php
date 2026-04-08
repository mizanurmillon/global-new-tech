<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('security_assessments')->insert([
            [
                'assigned_by' => 1,
                'assigned_to' => 2,
                'full_name' => 'Rahim Uddin',
                'email' => 'rahim@example.com',
                'phone_number' => '01700000001',
                'company_name' => 'Tech Solutions Ltd',
                'security_interest' => 'Web Security',
                'company_size' => '10-50',
                'timeline' => '1-2 months',
                'budget_range' => '$1000-$3000',
                'message' => 'We need a full website security audit.',
                'status' => 'pending',
                'note' => 'Follow up soon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'assigned_by' => 1,
                'assigned_to' => 3,
                'full_name' => 'Karim Hasan',
                'email' => 'karim@example.com',
                'phone_number' => '01700000002',
                'company_name' => 'Secure IT',
                'security_interest' => 'Network Security',
                'company_size' => '50-100',
                'timeline' => '3 months',
                'budget_range' => '$3000-$5000',
                'message' => 'Looking for network vulnerability testing.',
                'status' => 'in_progress',
                'note' => 'Client is responsive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'assigned_by' => 2,
                'assigned_to' => 3,
                'full_name' => 'Nusrat Jahan',
                'email' => 'nusrat@example.com',
                'phone_number' => '01700000003',
                'company_name' => 'Cyber Shield',
                'security_interest' => 'Cloud Security',
                'company_size' => '100+',
                'timeline' => 'Immediate',
                'budget_range' => '$5000+',
                'message' => 'Urgent cloud security assessment needed.',
                'status' => 'completed',
                'note' => 'Project delivered successfully',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}