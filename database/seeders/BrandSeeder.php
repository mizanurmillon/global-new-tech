<?php
namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {

        $datas = [
            [
                'name'        => 'Splunk',
                'subtitle'    => 'Operational intelligence and security information management platform.',
                'description' => '<p>
                <li>Splunk Enterprise Security (SIEM)</li>
                <li>Custom App Development</li>
                <li>User Behavior Analytics</li>
                </p>',
                'logo'        => '/uploads/brands/logo1.png',
                'website_url' => 'https://splunk.com',
            ],
            // Forcepoint
            [
                'name'        => 'Forcepoint',
                'subtitle'    => 'Human-centric cybersecurity solutions that adapt to risk in real-time.',
                'description' => '<p>
                <li>Data Loss Prevention</li>
                <li>Next-Gen Firewall</li>
                <li>Cloud Access Security Broker</li>
                </p>',
                'logo'        => '/uploads/brands/logo2.png',
                'website_url' => 'https://forcepoint.com',
            ],
            // CrowdStrike
            [
                'name'        => 'CrowdStrike',
                'subtitle'    => 'Cloud-delivered endpoint protection platform powered by AI and threat intelligence.',
                'description' => '<p>
                <li>Falcon Prevent (NGAV)</li>
                <li>Falcon Insight (EDR)</li>
                <li>Falcon Spotlight</li>
                </p>',
                'logo'        => '/uploads/brands/logo3.png',
                'website_url' => 'https://crowdstrike.com',
            ],
            // SentinelOne
            [
                'name'        => 'SentinelOne',
                'subtitle'    => 'Autonomous endpoint protection platform powered by machine learning.',
                'description' => '<p>
                <li>Singularity Complete (EPP/EDR)</li>
                <li>Ranger (IoT Security)</li>
                <li>Managed Detection & Response</li>
                </p>',
                'logo'        => '/uploads/brands/logo4.png',
                'website_url' => 'https://sentinelone.com',
            ],
            // Proofpoint
            [
                'name'        => 'Proofpoint',
                'subtitle'    => 'Cybersecurity and compliance solutions focused on protecting people and data.',
                'description' => '<p>
                <li>Email Security & Protection</li>
                <li>Advanced Threat Protection</li>
                <li>Security Awareness Training</li>
                </p>',
                'logo'        => '/uploads/brands/logo5.png',
                'website_url' => 'https://proofpoint.com',
            ],

            // Microsoft 365
            [
                'name'        => 'Microsoft 365',
                'subtitle'    => 'Productivity cloud that delivers best-of-breed productivity apps with intelligent cloud services',
                'description' => '<p>
                <li>Microsoft Defender for Endpoint</li>
                <li>Data Loss Prevention</li>
                <li>Microsoft Sentinel (Cloud SIEM)</li>
                </p>',
                'logo'        => '/uploads/brands/logo6.png',
                'website_url' => 'https://microsoft.com/microsoft-365',
            ],

            // Cisco
            [
                'name'        => 'Cisco',
                'subtitle'    => 'Global leader in networking and security infrastructure powering enterprise connectivity and protection.',
                'description' => '<p>
                <li>Cisco Secure Firewall</li>
                <li>Cisco Secure Endpoint</li>
                <li>Cisco Umbrella</li>
                </p>',
                'logo'        => '/uploads/brands/logo7.png',
                'website_url' => 'https://cisco.com',
            ],

            // Td Synnex
            [
                'name'        => 'Td Synnex',
                'subtitle'    => 'Global IT distributor and solutions aggregator delivering innovative technology, cloud services, and cybersecurity solutions to businesses worldwide.',
                'description' => '<p>
                <li>TD SYNNEX Cloud Solutions</li>
                <li>TD SYNNEX Data Center & Infrastructure.</li>
                <li>TD SYNNEX Cybersecurity Solutions</li>
                </p>',
                'logo'        => '/uploads/brands/logo8.png',
                'website_url' => 'https://tdsynnex.com',
            ],

        ];

        Brand::insert($datas);
    }
}
