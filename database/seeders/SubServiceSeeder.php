<?php
namespace Database\Seeders;

use App\Models\CoreService;
use Illuminate\Database\Seeder;

class SubServiceSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // 1. MANAGED SOC SERVICE — Sub Services
        // =====================================================================
        $soc = CoreService::where('slug', 'managed-soc-service')->first();

        if ($soc) {
            $soc->subServices()->delete();

            foreach ([
                [

                    "sub_service_icon"      => "/uploads/services/icons/time.png",
                    'sub_service_title'     => '24/7/365 Monitoring',
                    'sub_service_sub_title' => 'Round-the-clock security monitoring by expert analysts across all time zones. Your infrastructure is never unattended.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/beal.png",
                    'sub_service_title'     => 'Real-Time Threat Detection',
                    'sub_service_sub_title' => 'Advanced SIEM technology combined with AI-powered analytics to detect threats the moment they emerge.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/flash_1.png",
                    'sub_service_title'     => 'Rapid Incident Response',
                    'sub_service_sub_title' => 'Average 5-minute response time to critical alerts. Our team acts immediately to contain and neutralize threats.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/search.png",
                    'sub_service_title'     => 'Threat Investigation & Forensics',
                    'sub_service_sub_title' => 'Deep-dive analysis of security incidents to understand attack vectors, scope of compromise, and prevent recurrence.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/label.png",
                    'sub_service_title'     => 'Compliance Reporting',
                    'sub_service_sub_title' => 'Comprehensive reports for SOC 2, HIPAA, PCI-DSS, GDPR, and other regulatory frameworks. Audit-ready documentation.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/heart_response.png",
                    'sub_service_title'     => 'Threat Intelligence Integration',
                    'sub_service_sub_title' => 'Real-time feeds from global threat intelligence sources to stay ahead of emerging attack patterns.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/lock_1.png",
                    'sub_service_title'     => 'Vulnerability Management',
                    'sub_service_sub_title' => 'Continuous scanning and assessment of your infrastructure to identify and prioritize security weaknesses.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/people.png",
                    'sub_service_title'     => 'Dedicated Security Analysts',
                    'sub_service_sub_title' => 'Assigned team of certified security professionals who know your environment and business priorities.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/eyes.png",
                    'sub_service_title'     => 'Security Posture Dashboard',
                    'sub_service_sub_title' => 'Real-time visibility into your security status, active threats, and key metrics through intuitive dashboards.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/log.png",
                    'sub_service_title'     => 'Log Management & SIEM',
                    'sub_service_sub_title' => 'Centralized collection, storage, and analysis of logs from all your systems, applications, and network devices.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/danger.png",
                    'sub_service_title'     => 'Custom Security Playbooks',
                    'sub_service_sub_title' => 'Tailored response procedures specific to your infrastructure, applications, and business requirements.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/label.png",
                    'sub_service_title'     => 'Monthly Executive Reports',
                    'sub_service_sub_title' => 'Clear, business-focused reports showing security metrics, incidents handled, and recommendations for improvement.',
                ],
            ] as $sub) {
                $soc->subServices()->create($sub);
            }
        }

        // =====================================================================
        // 2. SECURITY SERVICES — Sub Services
        // =====================================================================
        $security = CoreService::where('slug', 'security-services')->first();

        if ($security) {
            $security->subServices()->delete();

            foreach ([
                [
                    'sub_service_title'       => 'Identity & Access Management',
                    'sub_service_sub_title'   => 'Ensure only authorized users access critical systems',
                    'sub_service_description' => '<ul>
                        <li>Multi-factor authentication (MFA) implementation</li>
                        <li>Single Sign-On (SSO) integration</li>
                        <li>Privileged access management (PAM)</li>
                        <li>Role-based access control (RBAC)</li>
                        <li>Identity lifecycle management</li>
                        <li>Access certification and reviews</li>
                        <li>Password policy enforcement</li>
                    </ul>',
                ],
                [
                    'sub_service_title'       => 'Network Security',
                    'sub_service_sub_title'   => 'Multi-layered network defense against external and internal threats',
                    'sub_service_description' => '<ul>
                        <li>Next-generation firewall deployment</li>
                        <li>Intrusion detection and prevention (IDS/IPS)</li>
                        <li>Network segmentation and micro-segmentation</li>
                        <li>VPN and secure remote access</li>
                        <li>DDoS protection and mitigation</li>
                        <li>Network traffic analysis</li>
                        <li>Zero Trust network architecture</li>
                        <li>Secure WiFi and wireless protection</li>
                    </ul>',
                ],
                [
                    'sub_service_title'       => 'Cloud Security',
                    'sub_service_sub_title'   => 'End-to-end cloud security for AWS, Azure, GCP, and hybrid environments',
                    'sub_service_description' => '<ul>
                        <li>Cloud security posture management (CSPM)</li>
                        <li>Cloud workload protection</li>
                        <li>Container and Kubernetes security</li>
                        <li>Cloud access security broker (CASB)</li>
                        <li>Data encryption and key management</li>
                        <li>Cloud-native application protection</li>
                        <li>Multi-cloud security orchestration</li>
                        <li>Serverless security</li>
                    </ul>',
                ],
                [
                    'sub_service_title'       => 'Compliance & Governance',
                    'sub_service_sub_title'   => 'Meet regulatory requirements and maintain security standards',
                    'sub_service_description' => '<ul>
                        <li>SOC 2 Type II compliance support</li>
                        <li>HIPAA/HITECH compliance</li>
                        <li>PCI-DSS assessment and remediation</li>
                        <li>GDPR data protection compliance</li>
                        <li>ISO 27001 certification support</li>
                        <li>NIST Cybersecurity Framework</li>
                        <li>Regular compliance audits</li>
                        <li>Policy development and management</li>
                    </ul>',
                ],
                [
                    'sub_service_title'       => 'Security Awareness Training',
                    'sub_service_sub_title'   => 'Transform your employees into your first line of defense',
                    'sub_service_description' => '<ul>
                        <li>Phishing simulation campaigns</li>
                        <li>Interactive security training modules</li>
                        <li>Social engineering awareness</li>
                        <li>Data protection best practices</li>
                        <li>Incident reporting procedures</li>
                        <li>Gamified learning experiences</li>
                        <li>Quarterly security updates</li>
                    </ul>',
                ],
            ] as $sub) {
                $security->subServices()->create($sub);
            }
        }

        // =====================================================================
        // 3. DEVOPS CONSULTING — Sub Services
        // =====================================================================
        $devops = CoreService::where('slug', 'devops-consulting')->first();

        if ($devops) {
            $devops->subServices()->delete();

            foreach ([
                [
                    "sub_service_icon"        => "/uploads/services/icons/right_person.png",
                    'sub_service_title'       => 'CI/CD Pipeline Implementation',
                    'sub_service_sub_title'   => 'Automate your software delivery with security built-in at every stage',
                    'sub_service_description' => '<p>Automate your software delivery pipeline from code commit to production deployment with security built-in at every stage.</p>
                    <ul>
                        <li>Deploy 10x faster with confidence</li>
                        <li>Reduce deployment errors by 90%</li>
                        <li>Catch security issues before production</li>
                        <li>Enable continuous delivery</li>
                    </ul>',
                ],
                [
                    "sub_service_icon"        => "/uploads/services/icons/right_person.png",
                    'sub_service_title'       => 'Container & Kubernetes Security',
                    'sub_service_sub_title'   => 'Secure containerized applications with industry best practices',
                    'sub_service_description' => '<p>Secure your containerized applications with industry best practices for Docker, Kubernetes, and cloud-native deployments.</p>
                    <ul>
                        <li>Prevent container breakout attacks</li>
                        <li>Enforce least privilege access</li>
                        <li>Real-time threat detection</li>
                        <li>Compliance-ready containers</li>
                    </ul>',
                ],
                [
                    "sub_service_icon"        => "/uploads/services/icons/right_person.png",
                    'sub_service_title'       => 'Infrastructure as Code (IaC)',
                    'sub_service_sub_title'   => 'Provision infrastructure through code with version control and security scanning',
                    'sub_service_description' => '<p>Manage and provision infrastructure through code with version control, automated testing, and security scanning.</p>
                    <ul>
                        <li>Infrastructure consistency guaranteed</li>
                        <li>Reduce manual errors to zero</li>
                        <li>Version control for infrastructure</li>
                        <li>Audit trail for all changes</li>
                    </ul>',
                ],
                [
                    "sub_service_icon"        => "/uploads/services/icons/right_person.png",
                    'sub_service_title'       => 'DevSecOps Integration',
                    'sub_service_sub_title'   => 'Embed security into DevOps workflows without slowing down',
                    'sub_service_description' => '<p>Embed security into your DevOps workflows with automated security testing, compliance, and vulnerability management.</p>
                    <ul>
                        <li>Find vulnerabilities 80% earlier</li>
                        <li>Reduce security debt</li>
                        <li>Meet compliance requirements</li>
                        <li>Security without slowing down</li>
                    </ul>',
                ],
            ] as $sub) {
                $devops->subServices()->create($sub);
            }
        }

        // =====================================================================
        // 1. AI-Powered Security Solutions — Sub Services
        // =====================================================================
        $soc = CoreService::where('slug', 'ai-powered-security-solutions')->first();

        if ($soc) {
            $soc->subServices()->delete();

            foreach ([
                [
                    "sub_service_icon"      => "/uploads/services/icons/1.png",
                    'sub_service_title'     => 'Data Ingestion',
                    'sub_service_sub_title' => 'Aggregate logs and telemetry from all sources.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/2.png",
                    'sub_service_title'     => 'AI/ML Analysis',
                    'sub_service_sub_title' => 'Models analyze data for anomalies and threats.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/3.png",
                    'sub_service_title'     => 'Threat Validation',
                    'sub_service_sub_title' => 'Contextual enrichment and false positive reduction.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/4.png",
                    'sub_service_title'     => 'Automated Response',
                    'sub_service_sub_title' => 'AI triggers playbooks to contain the threat.',
                ],
                [
                    "sub_service_icon"      => "/uploads/services/icons/5.png",
                    'sub_service_title'     => 'Continuous Learning',
                    'sub_service_sub_title' => 'Models retrain on new data to stay ahead.',
                ],
            ] as $sub) {
                $soc->subServices()->create($sub);
            }
        }
    }
}
