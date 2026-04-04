<?php
namespace Database\Seeders;

use App\Models\CoreService;
use Illuminate\Database\Seeder;

class CoreServiceSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // 1. MANAGED SOC SERVICE
        // =====================================================================
        $soc = CoreService::firstOrCreate(
            ['slug' => 'managed-soc-service'],
            [
                "hero_image"            => "/uploads/services/service_1.png",
                'hero_title'            => '24/7 Managed SOC Services',
                'hero_description'      => 'Enterprise-grade security operations center monitoring and incident response, tailored to your business needs. Stop threats before they cause damage.',
                'main_section_title'    => "What's Included in Managed SOC",
                'main_section_subtitle' => 'Comprehensive security monitoring and response capabilities designed to protect your organization from evolving cyber threats.',
                "service_icon"          => "/uploads/services/icons/guard.png",
                'service_title'         => "Managed SOC Service",
                'service_subtitle'      => '24/7 security operations centre monitoring with expert analysts and rapid incident response.',
                'service_description'   => '<ul>
                    <li>Reduce security incidents by 90%</li>
                    <li>5-minute average response time</li>
                    <li>Expert-level security without hiring costs</li>
                    <li>Complete audit trail for compliance</li>
                </ul>',
                'work_section_title'    => 'How Our SOC Works',
                'work_section_subtitle' => 'A proven five-step process to protect your organization around the clock',
                'is_active'             => true,
            ]
        );

        $soc->serviceValues()->delete();
        foreach ([
            ['value' => '90%', 'value_title' => 'Reduction in Security Incidents', 'value_sub_title' => 'Proactive monitoring prevents attacks before they cause damage'],
            ['value' => '5 min', 'value_title' => 'Average Response Time', 'value_sub_title' => 'Faster than hiring in-house teams can achieve'],
            ['value' => '99.9%', 'value_title' => 'Uptime SLA', 'value_sub_title' => 'Your security monitoring is always operational'],
            ['value' => '70%', 'value_title' => 'Cost Savings vs In-House', 'value_sub_title' => 'Get expert security without the hiring and training costs'],
        ] as $val) {
            $soc->serviceValues()->create($val);
        }

        $soc->howToWorkServices()->delete();
        foreach ([
            ["how_to_work_icon" => "uploads/services/icons/1.png", 'how_to_work_title' => 'Onboarding & Integration', 'how_to_work_sub_title' => 'We integrate with your existing infrastructure, configure log sources, and establish baseline security policies.'],
            ["how_to_work_icon" => "uploads/services/icons/2.png", 'how_to_work_title' => 'Continuous Monitoring', 'how_to_work_sub_title' => 'Our SOC analysts monitor your environment 24/7, using advanced SIEM and threat detection technologies.'],
            ["how_to_work_icon" => "uploads/services/icons/3.png", 'how_to_work_title' => 'Threat Detection & Analysis', 'how_to_work_sub_title' => 'When suspicious activity is detected, our team investigates immediately to determine if it\'s a real threat.'],
            ["how_to_work_icon" => "uploads/services/icons/4.png", 'how_to_work_title' => 'Incident Response & Containment', 'how_to_work_sub_title' => 'Confirmed threats are contained and neutralized following your custom playbooks and our proven procedures.'],
            ["how_to_work_icon" => "uploads/services/icons/5.png", 'how_to_work_title' => 'Reporting & Improvement', 'how_to_work_sub_title' => 'We provide detailed incident reports and work with you to continuously improve your security posture.'],
        ] as $step) {
            $soc->howToWorkServices()->create($step);
        }

        // =====================================================================
        // 2. SECURITY SERVICES
        // =====================================================================
        $security = CoreService::firstOrCreate(
            ['slug' => 'security-services'],
            [
                "hero_image"            => "/uploads/services/service_2.png",
                'hero_title'            => 'Comprehensive Security Services',
                'hero_description'      => 'Protect every layer of your organization with enterprise-grade security solutions. From identity management to cloud security, we provide complete coverage.',
                'main_section_title'    => 'Our Security Service Portfolio',
                'main_section_subtitle' => 'Comprehensive security monitoring and response capabilities designed to protect your organization from evolving cyber threats.',
                "service_icon"          => "/uploads/services/icons/gurarded.png",
                'service_title'         => 'Security Services',
                'service_subtitle'      => 'Comprehensive cybersecurity solutions covering identity, network, cloud, compliance, and employee training.',
                'service_description'   => '<ul>
                    <li>Complete security coverage across all layers</li>
                    <li>Expert implementation and management</li>
                    <li>Meet regulatory compliance requirements</li>
                    <li>Transform employees into security assets</li>
                </ul>',
                'work_section_title'    => 'Why Choose Our Security Services',
                'work_section_subtitle' => 'Expert-led security implementation and management that protects your business 24/7',
                'is_active'             => true,
            ]
        );

        $security->serviceValues()->delete();
        foreach ([
            ['value' => '100%', 'value_title' => 'Security Coverage', 'value_sub_title' => 'Every layer of your organization protected'],
            ['value' => '85%', 'value_title' => 'Faster Implementation', 'value_sub_title' => 'Compared to building in-house capabilities'],
            ['value' => '24/7', 'value_title' => 'Continuous Protection', 'value_sub_title' => 'Round-the-clock monitoring and support'],
            ['value' => '500+', 'value_title' => 'Organizations Protected', 'value_sub_title' => 'Trusted by businesses worldwide'],
        ] as $val) {
            $security->serviceValues()->create($val);
        }

        $security->howToWorkServices()->delete();
        foreach ([
            ["how_to_work_icon" => "/uploads/services/icons/guard.png", "how_to_work_title" => 'Comprehensive Protection', "how_to_work_sub_title" => 'End-to-end security coverage from identity to cloud, ensuring no gaps in your defense.'],
            ["how_to_work_icon" => "/uploads/services/icons/peoples.png", "how_to_work_title" => 'Expert Implementation', "how_to_work_sub_title" => 'Certified professionals with deep expertise in deploying and managing enterprise security.'],
            ["how_to_work_icon" => "/uploads/services/icons/eyes.png", "how_to_work_title" => 'Continuous Monitoring', "how_to_work_sub_title" => '24/7 oversight of all security controls with proactive threat detection and response.'],
            ["how_to_work_icon" => "/uploads/services/icons/log.png", "how_to_work_title" => 'Integrated Solutions', "how_to_work_sub_title" => 'Seamless integration across all security layers for unified visibility and control.'],
        ] as $step) {
            $security->howToWorkServices()->create($step);
        }

        // =====================================================================
        // 3. DEVOPS CONSULTING
        // =====================================================================
        $devops = CoreService::firstOrCreate(
            ['slug' => 'devops-consulting'],
            [
                "hero_image"            => "/uploads/services/service_3.png",
                'hero_title'            => 'DevOps Consulting With Security Built-In',
                'hero_description'      => 'Transform your software delivery with secure, automated CI/CD pipelines, cloud-native infrastructure, and DevSecOps best practices. Deploy 10x faster with confidence.',
                'main_section_title'    => 'Our DevOps Service Offerings',
                'main_section_subtitle' => 'End-to-end DevOps solutions that accelerate delivery while maintaining security and compliance.',
                "service_icon"          => "/uploads/services/icons/flash_1.png",
                'service_title'         => 'DevOps Consulting',
                'service_subtitle'      => 'Streamline your development operations with secure, scalable infrastructure and CI/CD.',
                'service_description'   => '<ul>
                    <li>Deploy securely 10x faster</li>
                    <li>Reduce security vulnerabilities in code</li>
                    <li>Automate compliance requirements</li>
                    <li>Scale infrastructure securely</li>
                </ul>',
                'work_section_title'    => 'Our DevOps Implementation Process',
                'work_section_subtitle' => 'A proven methodology to transform your development and operations',
                'is_active'             => true,
            ]
        );

        $devops->serviceValues()->delete();
        foreach ([
            ['value' => '10x', 'value_title' => 'Security Coverage', 'value_sub_title' => 'Automates your pipeline and deploy in minutes, not days'],
            ['value' => '80%', 'value_title' => 'Earlier Security Detection', 'value_sub_title' => 'Catch vulnerabilities before they reach production'],
            ['value' => '90%', 'value_title' => 'Fewer Errors', 'value_sub_title' => 'Automated testing and validation at every stage'],
            ['value' => '100%', 'value_title' => 'Infrastructure as Code', 'value_sub_title' => 'Fully automated, repeatable infrastructure deployments'],
        ] as $val) {
            $devops->serviceValues()->create($val);
        }

        $devops->howToWorkServices()->delete();
        foreach ([
            ["how_to_work_icon" => "/uploads/services/icons/log.png", 'how_to_work_title' => 'Assessment & Planning', 'how_to_work_sub_title' => 'We evaluate your current infrastructure, development processes, and security posture to create a tailored DevOps roadmap.'],
            ["how_to_work_icon" => "/uploads/services/icons/s_design.png", 'how_to_work_title' => 'Pipeline Design', 'how_to_work_sub_title' => 'Design and architect secure CI/CD pipelines with automated testing, security scanning, and deployment strategies.'],
            ["how_to_work_icon" => "/uploads/services/icons/tag.png", 'how_to_work_title' => 'Implementation', 'how_to_work_sub_title' => 'Build and deploy your DevOps infrastructure with IaC, containerization, and orchestration tools.'],
            ["how_to_work_icon" => "/uploads/services/icons/guard.png", 'how_to_work_title' => 'Security Integration', 'how_to_work_sub_title' => 'Embed security controls, scanning, and compliance checks throughout your development lifecycle.'],
            ["how_to_work_icon" => "/uploads/services/icons/incress.png", 'how_to_work_title' => 'Training & Optimization', 'how_to_work_sub_title' => 'Train your team and continuously optimize pipelines for speed, security, and reliability.'],
        ] as $step) {
            $devops->howToWorkServices()->create($step);
        }

        // =====================================================================
        // 4. AI-POWERED SECURITY SOLUTIONS
        // =====================================================================
        $ai = CoreService::firstOrCreate(
            ['slug' => 'ai-powered-security-solutions'],
            [
                "hero_image"            => "/uploads/services/service_4.png",
                'hero_title'            => 'AI-Powered Cybersecurity: The Future of Defence',
                'hero_description'      => 'Harness the power of Artificial Intelligence and Machine Learning to move beyond traditional defense and build a predictive, autonomous, and resilient security posture.',
                'main_section_title'    => 'Our AI-Driven Security Process',
                'main_section_subtitle' => 'A continuous, intelligent loop that gets smarter over time.',
                "service_icon"          => "/uploads/services/icons/brain.png",
                'service_title'         => 'AI-Powered Security Solutions',
                'service_subtitle'      => 'Advanced artificial intelligence and machine learning solutions for predictive threat analysis.',
                'service_description'   => '<ul>
                    <li>Detect unknown threats before they cause damage</li>
                    <li>Reduce false positives by 80%</li>
                    <li>Automate 70% of routine security tasks</li>
                    <li>Predict attacks before they happen</li>
                </ul>',
                'work_section_title'    => 'Our AI & Machine Learning Capabilities',
                'work_section_subtitle' => 'We deliver a suite of intelligent security services designed to protect every layer of your organization.',
                'is_active'             => true,
            ]
        );

        $ai->serviceValues()->delete();
        foreach ([
            ['value' => '95%', 'value_title' => 'Reduction in False Positives', 'value_sub_title' => 'AI filters noise so your team focuses on real threats'],
            ['value' => '40x', 'value_title' => 'Faster Threat Detection', 'value_sub_title' => 'Free your team from repetitive manual security work'],
            ['value' => '75%', 'value_title' => 'Fewer Analyst Alerts', 'value_sub_title' => 'ML models trained on billions of threat signals'],
            ['value' => '100%', 'value_title' => 'Coverage of MITRE ATT&CK', 'value_sub_title' => 'AI never sleeps — continuous protection around the clock'],
        ] as $val) {
            $ai->serviceValues()->create($val);
        }

        $ai->howToWorkServices()->delete();
        foreach ([
            ["how_to_work_icon" => "/uploads/services/icons/log.png", 'how_to_work_title' => 'Predictive Threat Analytics', 'how_to_work_sub_title' => 'Our AI models analyze millions of data points to forecast potential attack vectors and identify emerging threats before they strike, moving your security posture from reactive to predictive.'],
            ["how_to_work_icon" => "/uploads/services/icons/s_design.png", 'how_to_work_title' => 'Autonomous Threat Response', 'how_to_work_sub_title' => 'Leverage AI to automate incident response at machine speed. Threats are neutralized in seconds, minimizing dwell time and potential damage without requiring human intervention for known patterns.'],
            ["how_to_work_icon" => "/uploads/services/icons/tag.png", 'how_to_work_title' => 'Behavioral Analytics (UEBA)', 'how_to_work_sub_title' => 'We establish a baseline of normal user and entity behavior. Our AI engine instantly detects anomalies and risky deviations, uncovering insider threats and compromised accounts.'],
            ["how_to_work_icon" => "/uploads/services/icons/guard.png", 'how_to_work_title' => 'AI-Driven Security Operations', 'how_to_work_sub_title' => 'Enhance your SOC with AI. We automate alert triage, correlate disparate events into single incidents, and provide analysts with rich, contextual data to accelerate investigation.'],
        ] as $step) {
            $ai->howToWorkServices()->create($step);
        }

        // =====================================================================
        // 5. PARTNER SOLUTION INTEGRATION
        // =====================================================================
        $partner = CoreService::firstOrCreate(
            ['slug' => 'partner-solution-integration'],
            [
                "hero_image"            => null,
                'hero_title'            => null,
                'hero_description'      => null,
                'main_section_title'    => null,
                'main_section_subtitle' => null,
                "service_icon"          => "/uploads/services/icons/networks.png",
                'service_title'         => 'Partner Solution Integration',
                'service_subtitle'      => 'Best-in-class cybersecurity solutions from leading vendors, integrated and optimized for your needs.',
                'service_description'   => '<ul>
                    <li>Best-of-breed security stack</li>
                    <li>Unified security management</li>
                    <li>Vendor relationship management</li>
                    <li>Ongoing support and optimization</li>
                </ul>',
                'work_section_title'    => null,
                'work_section_subtitle' => null,
                'is_active'             => true,
            ]
        );

        // $partner->serviceValues()->delete();
        // foreach ([
        //     ['value' => '50+', 'value_title' => 'Vendor Partners', 'value_sub_title' => 'Relationships with the world\'s leading security vendors'],
        //     ['value' => '100%', 'value_title' => 'Unified Management', 'value_sub_title' => 'Single pane of glass for all integrated solutions'],
        //     ['value' => '60%', 'value_title' => 'Faster Vendor Deployment', 'value_sub_title' => 'Pre-built integrations accelerate time to value'],
        //     ['value' => '24/7', 'value_title' => 'Ongoing Support', 'value_sub_title' => 'Continuous optimization and vendor management'],
        // ] as $val) {
        //     $partner->serviceValues()->create($val);
        // }

        // $partner->howToWorkServices()->delete();
        // foreach ([
        //     ['how_to_work_title' => 'Needs Assessment', 'how_to_work_sub_title' => 'We analyze your current security stack and business requirements to identify the right vendor solutions.'],
        //     ['how_to_work_title' => 'Vendor Selection', 'how_to_work_sub_title' => 'Leverage our partner network to select best-fit solutions that align with your budget and goals.'],
        //     ['how_to_work_title' => 'Integration & Deployment', 'how_to_work_sub_title' => 'Seamlessly deploy and integrate vendor solutions into your existing infrastructure with minimal disruption.'],
        //     ['how_to_work_title' => 'Unified Management', 'how_to_work_sub_title' => 'Consolidate visibility and control across all vendor tools through a single management platform.'],
        //     ['how_to_work_title' => 'Support & Optimization', 'how_to_work_sub_title' => 'Ongoing vendor relationship management, license optimization, and continuous performance tuning.'],
        // ] as $step) {
        //     $partner->howToWorkServices()->create($step);
        // }
    }
}
