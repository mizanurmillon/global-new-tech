<?php
namespace Database\Seeders;

use App\Enum\Page;
use App\Enum\Section;
use App\Models\CmsContent;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [

            // Home Page Sections
            [
                'page'             => Page::HOME->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => 'Secure Your Business with Advanced AI',
                'description'      => 'Global New Tech offers managed SOC, AI-driven cybersecurity, and DevOps solutions to keep your business secure.',
                'background_image' => '/uploads/cms/backgrounds/home_image.png',
            ],
            [
                'page'     => Page::HOME->value,
                'section'  => Section::ABOUT_SECTION->value,
                'title'    => 'About Us',
                'subtitle' => 'We combine technical expertise with business acumen to deliver solutions that drive real results.',
            ],
            [
                'page'     => Page::HOME->value,
                'section'  => Section::SERVICES_SECTION->value,
                'title'    => 'Our Services',
                'subtitle' => 'Comprehensive technology solutions designed to drive your business forward',
            ],
            [
                'page'     => Page::HOME->value,
                'section'  => Section::TRUSTED_PARTNERS_SECTION->value,
                'title'    => 'Our Trusted Partner Ecosystem',
                'subtitle' => 'We integrate and resell solutions from industry-leading cybersecurity vendors to provide you with a best-in-class, unified security posture.',
            ],
            [
                'page'     => Page::HOME->value,
                'section'  => Section::BLOG_SECTION->value,
                'title'    => 'Blog & Articles',
                'subtitle' => 'Stay informed about the latest cybersecurity trends, threats, and solutions from our team of security experts.',

            ],
            [
                'page'     => Page::HOME->value,
                'section'  => Section::TESTIMONIALS_SECTION->value,
                'title'    => 'Client Trust & Feedback',
                'subtitle' => "Don't just take our word for it. Hear what our clients have to say about protecting their organizations with Global New Tech.",

            ],
            [
                'page'        => Page::HOME->value,
                'section'     => Section::SUB_FOOTER_SECTION->value,
                'title'       => 'Ready to Transform Your Business?',
                'subtitle'    => "Let's discuss how we can help you achieve your technology goals",
                'button_text' => 'Request a demo',
                'button_link' => '#',
            ],

            [
                'page'     => Page::HOME->value,
                'section'  => Section::FOOTER_SECTION->value,
                'title'    => 'GLOBAL NEW TECH',
                'subtitle' => "INNOVATION SECURITY SERVICES",
                'image'    => '/uploads/cms/items/footer_images.png',
            ],

            //services page section
            [
                'page'             => Page::SERVICES->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => 'Enterprise Cybersecurity Services',
                'description'      => 'Comprehensive security solutions designed to protect your business from evolving cyber threats with 24/7 monitoring, AI-powered detection, and expert response capabilities.',
                'background_image' => '/uploads/cms/backgrounds/service.png',
            ],
            [
                'page'     => Page::SERVICES->value,
                'section'  => Section::SERVICES_SECTION->value,
                'title'    => 'Our Core Service Offerings',
                'subtitle' => 'From managed security operations to AI-powered threat detection, we provide enterprise-grade protection tailored to your business needs.',
            ],

            [
                'page'     => Page::SERVICES->value,
                'section'  => Section::COMPREHENSIVE_SERVICES_SECTION->value,
                'title'    => 'Comprehensive Security Services',
                'subtitle' => 'Every layer of your organization protected with enterprise-grade security controls and expert implementation.',
            ],
            [
                'page'     => Page::SERVICES->value,
                'section'  => Section::NUMBER_SECTION->value,
                'title'    => 'Comprehensive Security Services',
                'subtitle' => 'Every layer of your organization protected with enterprise-grade security controls and expert implementation.',
            ],

            [
                'page'     => Page::SERVICES->value,
                'section'  => Section::CONTACT_SECTION->value,
                'title'    => 'Why Choose Our Security Services',
                'subtitle' => 'Expert-led security implementation and management that protects your business 24/7',
                'image'    => '/uploads/cms/items/footer_images.png',
            ],
            // project page section
            [
                'page'             => Page::ABOUT->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => 'About Global Tech',
                'description'      => 'Global New Tech has been at the forefront of cybersecurity innovation, providing managed SOC services, AI-powered solutions, and DevOps consulting to organizations worldwide.',
                'background_image' => '/uploads/cms/backgrounds/service.png',
            ],
            [
                'page'    => Page::ABOUT->value,
                'section' => Section::ABOUT_SECTION->value,
                'title'   => 'Recent Work Highlights',
            ],
            [
                'page'    => Page::ABOUT->value,
                'section' => Section::NUMBER_SECTION->value,
                'title'   => 'number',
            ],

            [
                'page'        => Page::ABOUT->value,
                'section'     => Section::OUR_STORY_SECTION->value,
                'title'       => 'Our Story',
                'description' => "Global New Tech is on a mission to safeguard America's vital government systems in the face of the recent cyberattack surge. A solid Organization defence starts with robust cybersecurity. Through our unparalleled innovation, Global New Tech offers centralized, expert-led services to shield critical applications, respond to threats, and make cybersecurity more cost-effective for all government agencies. We Implement innovative strategies to protect and enable core business operations by providing centralized services with highly skilled resources for cyber threat defence and response.",
                'image'       => '/uploads/cms/items/About.png',
            ],

            [
                'page'     => Page::ABOUT->value,
                'section'  => Section::OUR_CORE_VALUES_SECTION->value,
                'title'    => 'Our Core Value',
                'subtitle' => "The principles that guide our approach to cybersecurity and client relationships",

            ],

            [
                'page'     => Page::ABOUT->value,
                'section'  => Section::TEAM_SECTION->value,
                'title'    => 'Meat Our Leadership Team',
                'subtitle' => "Meet the experts driving our success",
            ],

            [
                'page'     => Page::ABOUT->value,
                'section'  => Section::TRUSTED_PARTNERS_SECTION->value,
                'title'    => 'Our Trusted Partner Ecosystem',
                'subtitle' => "We integrate and resell solutions from industry-leading cybersecurity vendors to provide you with a best-in-class, unified security posture.",
            ],
            // blog page section
            [
                'page'             => Page::BLOG->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => 'Blog & Articles',
                'description'      => "Stay informed about the latest cybersecurity trends, threats, and solutions from our team of security experts.",
                'background_image' => '/uploads/cms/backgrounds/service.png',
            ],
            [
                'page'    => Page::BLOG->value,
                'section' => Section::BLOG_SECTION->value,
                'title'   => 'Our largest News Blog',
            ],

            // Contact page section

            [
                'page'             => Page::CONTACT->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => "Let's Secure Your Business Together",
                'description'      => 'Ready to enhance your cybersecurity posture? Our experts are here to help you build a comprehensive defense strategy tailored to your organization.',
                'background_image' => '/uploads/cms/backgrounds/service.png',
            ],
            [
                'page'     => Page::CONTACT->value,
                'section'  => Section::CONTACT_SECTION->value,
                'title'    => 'Ready to Enhance Your Security?',
                'subtitle' => 'Get a free security assessment and discover how our managed SOC can protect your organization.',

            ],

            [
                'page'    => Page::CONTACT->value,
                'section' => Section::SERVICES_SECTION->value,
                'title'   => 'this is title for SERVICES_SECTION',

            ],

            //partner section ___________________________________

            [
                'page'             => Page::PARTNER->value,
                'section'          => Section::HERO_SECTION->value,
                'title'            => "Powered by the World's Best Security Platforms",
                'description'      => 'We integrate, deploy, and manage enterprise-grade solutions from Cisco, Splunk, M365, SentinelOne, CrowdStrike, Proofpoint, and Forcepoint—creating a unified security ecosystem with no gaps in coverage.',
                'background_image' => '/uploads/cms/backgrounds/service.png',

            ],

            [
                'page'     => Page::PARTNER->value,
                'section'  => Section::TRUSTED_PARTNERS_SECTION->value,
                'title'    => "Our Trusted Partners",
                'subtitle' => 'We collaborate with industry leaders to deliver comprehensive security solutions for your business.',

            ],
            [
                'page'        => Page::PARTNER->value,
                'section'     => Section::SUB_FOOTER_SECTION->value,
                'title'       => 'Ready to strengthen your security posture?',
                'subtitle'    => "Leverage our partnerships with industry leaders to build a comprehensive security strategy.",
                'button_text' => 'Contact Our Team',
                'button_link' => '#',
            ],

        ];

        foreach ($contents as $content) {
            CmsContent::updateOrCreate(
                [
                    'page'    => $content['page'],
                    'section' => $content['section'],
                ],
                $content
            );
        }
    }
}
