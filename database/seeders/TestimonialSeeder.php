<?php
namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Sarah Johnson',
                'position'   => 'CTO, TechCorp',
                'bio'        => 'Fortune 500 Technology Company',
                'image'      => '/uploads/testimonials/user1.png',
                'rating'     => 5,
                'text'       => "global new Tech's managed SOC services have been transformative for our security posture. Their 24/7 monitoring and rapid incident response have prevented multiple potential breaches. The team's expertiseisunmatched . ",
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Michael Chen',
                'position'   => 'CISO, FinanceFirst Bank',
                'bio'        => 'Leading Financial Institution',
                'image'      => '/uploads/testimonials/user2.png',
                'rating'     => 4,
                'text'       => "The AI-powered threat detection has given us a significant edge in identifying and neutralizing threats before they impact our operations. Their compliance expertise helped us meet all regulatory requirements seamlessly.",
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Emily Rodriguez',
                'position'   => 'VP of Operations, HealthPlus',
                'bio'        => 'Healthcare Technology Provider',
                'image'      => '/uploads/testimonials/user3.png',
                'rating'     => 5,
                'text'       => "We've partnered with Global New Tech for over two years, and their service quality has been consistently excellent. The DevOps consulting helped us modernize our infrastructure while maintaining the highest security standards required in healthcare.",
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        Testimonial::insert($data);
    }
}
