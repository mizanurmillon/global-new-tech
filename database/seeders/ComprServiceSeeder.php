<?php
namespace Database\Seeders;

use App\Models\ComprService;
use Illuminate\Database\Seeder;

class ComprServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // ---- Highlight Cards (top 3) ----
            [
                'title'             => '24/7 Protection',
                'short_description' => 'Round-the-clock monitoring and incident response from our expert security operations center.',
                'is_active'         => true,
            ],
            [
                'title'             => 'AI-Powered Defense',
                'short_description' => 'Advanced machine learning algorithms detect and respond to threats before they cause damage.',
                'is_active'         => true,
            ],
            [
                'title'             => 'Expert Team',
                'short_description' => 'Certified security professionals with decades of combined experience protecting businesses.',
                'is_active'         => true,
            ],

            // ---- Main Service Cards ----
            [
                'title'             => 'Identity & Access Management',
                'short_description' => 'Comprehensive IAM solutions to ensure only authorized users access your critical systems and data.',
                'description'       => '<ul>
                    <li>Multi-factor authentication (MFA) implementation</li>
                    <li>Single Sign-On (SSO) integration</li>
                    <li>Privileged access management (PAM)</li>
                    <li>Role-based access control (RBAC)</li>
                    <li>Identity lifecycle management</li>
                    <li>Access certification and reviews</li>
                    <li>Password policy enforcement</li>
                    <li>Just-in-time access provisioning</li>
                </ul>',
                'is_active'         => true,
            ],
            [
                'title'             => 'Network Security',
                'short_description' => 'Multi-layered network defense to protect your infrastructure from external and internal threats.',
                'description'       => '<ul>
                    <li>Next-generation firewall deployment</li>
                    <li>Intrusion detection and prevention (IDS/IPS)</li>
                    <li>Network segmentation and micro-segmentation</li>
                    <li>VPN and secure remote access</li>
                    <li>DDoS protection and mitigation</li>
                    <li>Network traffic analysis</li>
                    <li>Zero Trust network architecture</li>
                    <li>Secure WiFi and wireless protection</li>
                </ul>',
                'is_active'         => true,
            ],
            [
                'title'             => 'Cloud Security',
                'short_description' => 'End-to-end cloud security for AWS, Azure, GCP, and hybrid cloud environments.',
                'description'       => '<ul>
                    <li>Cloud security posture management (CSPM)</li>
                    <li>Cloud workload protection</li>
                    <li>Container and Kubernetes security</li>
                    <li>Cloud access security broker (CASB)</li>
                    <li>Data encryption and key management</li>
                    <li>Cloud-native application protection</li>
                    <li>Multi-cloud security orchestration</li>
                    <li>Serverless security</li>
                </ul>',
                'is_active'         => true,
            ],
            [
                'title'             => 'Compliance & Governance',
                'short_description' => 'Meet regulatory requirements and maintain security standards across your organization.',
                'description'       => '<ul>
                    <li>SOC 2 Type II compliance support</li>
                    <li>HIPAA/HITECH compliance</li>
                    <li>PCI-DSS assessment and remediation</li>
                    <li>GDPR data protection compliance</li>
                    <li>ISO 27001 certification support</li>
                    <li>NIST Cybersecurity Framework</li>
                    <li>Regular compliance audits</li>
                    <li>Policy development and management</li>
                </ul>',
                'is_active'         => true,
            ],
            [
                'title'             => 'Security Awareness Training',
                'short_description' => 'Transform your employees into your first line of defense against cyber threats.',
                'description'       => '<ul>
                    <li>Phishing simulation campaigns</li>
                    <li>Interactive security training modules</li>
                    <li>Social engineering awareness</li>
                    <li>Data protection best practices</li>
                    <li>Incident reporting procedures</li>
                    <li>Role-specific security training</li>
                    <li>Gamified learning experiences</li>
                    <li>Quarterly security updates</li>
                </ul>',
                'is_active'         => true,
            ],
        ];

        foreach ($services as $service) {
            ComprService::firstOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
