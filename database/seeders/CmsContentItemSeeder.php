<?php
namespace Database\Seeders;

use App\Enum\Page;
use App\Enum\Section;
use App\Models\CmsContent;
use App\Models\CmsContentItem;
use Illuminate\Database\Seeder;

class CmsContentItemSeeder extends Seeder
{
    public function run(): void
    {
        // === HOME_SECTION Items ===
        $home = CmsContent::where('page', Page::HOME->value)
            ->where('section', Section::HERO_SECTION->value)
            ->first();
        if ($home) {
            CmsContentItem::insert([
                [
                    'content_id' => $home->id,
                    'title'      => '500+',
                    'subtitle'   => 'Threats Blocked Daily',
                ],
                [
                    'content_id' => $home->id,
                    'title'      => '1000+',
                    'subtitle'   => 'Endpoints Protected',
                ],
                [
                    'content_id' => $home->id,
                    'title'      => '99.9%',
                    'subtitle'   => 'Uptime SLA',
                ],
                [
                    'content_id' => $home->id,
                    'title'      => '50+',
                    'subtitle'   => 'Enterprise Clients',
                ],
            ]);
        }
        // === ABOUT HERO_SECTION  Items ===
        $about = CmsContent::where('page', Page::HOME->value)
            ->where('section', Section::ABOUT_SECTION->value)
            ->first();
        if ($about) {
            CmsContentItem::insert([
                [
                    'content_id'  => $about->id,
                    'title'       => 'Our Story',
                    'description' => "Global New Tech is on a mission to safeguard America's vital government systems in the face of the recent cyberattack surge. A solid Organization defence starts with robust cybersecurity. Through our unparalleled innovation, Global New Tech offers centralized, expert-led services to shield critical applications, respond to threats, and make cybersecurity more cost-effective for all government agencies. We Implement innovative strategies to protect and enable core business operations by providing centralized services with highly skilled resources for cyber threat defence and response.",
                    'image'       => "/uploads/cms/items/about_section.png",
                ],

            ]);
        }

        // === ABOUT About_SECTION  Items ===
        $about_s = CmsContent::where('page', Page::HOME->value)
            ->where('section', Section::SERVICES_SECTION->value)
            ->first();
        if ($about_s) {
            CmsContentItem::insert([
                [
                    'content_id' => $about_s->id,
                    'title'      => 'Tyler Grasmick & Chris Figureida',
                ],
                [
                    'content_id' => $about_s->id,
                    'title'      => 'Wildland mitigation & HIZ assessments',
                ],
                [
                    'content_id' => $about_s->id,
                    'title'      => 'Exterior sprinkler & foam systems',
                ],
                [
                    'content_id' => $about_s->id,
                    'title'      => 'Private resource planning & readiness',
                ],
            ]);
        }

        $service_s = CmsContent::where('page', Page::SERVICES->value)
            ->where('section', Section::NUMBER_SECTION->value)
            ->first();

        if ($service_s) {
            CmsContentItem::insert([
                [
                    'content_id' => $service_s->id,
                    'title'      => '500+',
                    'subtitle'   => 'Client Endpoints Secured',
                ],
                [
                    'content_id' => $service_s->id,
                    'title'      => '99.9%',
                    'subtitle'   => 'Uptime Achieve',
                ],
                [
                    'content_id' => $service_s->id,
                    'title'      => '<5min',
                    'subtitle'   => 'Average Response Time',
                ],
                [
                    'content_id' => $service_s->id,
                    'title'      => '24/7',
                    'subtitle'   => 'Expert Monitoring',
                ],
            ]);
        }

        $ab_v_s = CmsContent::where('page', Page::ABOUT->value)
            ->where('section', Section::ABOUT_SECTION->value)
            ->first();

        if ($ab_v_s) {
            CmsContentItem::insert([
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/About.png',
                    'title'       => 'Our Mission',
                    'description' => 'To empower businesses worldwide with innovative technology solutions that drive growth, efficiency, and competitive advantage. We are committed to delivering excellence through continuous innovation and exceptional service.',
                ],
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/eyes.png',
                    'title'       => 'Our Vision',
                    'description' => 'To be the global leader in technology innovation, recognized for transforming businesses through cutting-edge solutions and unparalleled expertise. We envision a future where technology seamlessly enhances every aspect of business operations.',
                ],

            ]);
        }

        $ab_n_s = CmsContent::where('page', Page::ABOUT->value)
            ->where('section', Section::NUMBER_SECTION->value)
            ->first();

        if ($ab_n_s) {
            CmsContentItem::insert([
                [
                    'content_id' => $ab_n_s->id,
                    'title'      => '500+',
                    'subtitle'   => 'Client Endpoints Secured',
                ],
                [
                    'content_id' => $ab_n_s->id,
                    'title'      => '99.9%',
                    'subtitle'   => 'Uptime Achieve',
                ],
                [
                    'content_id' => $ab_n_s->id,
                    'title'      => '<5min',
                    'subtitle'   => 'Average Response Time',
                ],
                [
                    'content_id' => $ab_n_s->id,
                    'title'      => '50M+',
                    'subtitle'   => 'Events Analysed Daily',
                ],
            ]);
        }

        $ab_v_s = CmsContent::where('page', Page::ABOUT->value)
            ->where('section', Section::OUR_CORE_VALUES_SECTION->value)
            ->first();

        if ($ab_v_s) {
            CmsContentItem::insert([
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/icon1.png',
                    'title'       => 'Security First',
                    'description' => "Every decision we make prioritizes the security and protection of our clients' digital assets.",
                ],
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/icon3.png',
                    'title'       => 'Expert Team',
                    'description' => "Our certified professionals bring decades of combined experience in cybersecurity and risk management.",
                ],
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/icon2.png',
                    'title'       => 'Excellence',
                    'description' => "We maintain the highest standards of service delivery and continuously improve our capabilities.",
                ],
                [
                    'content_id'  => $ab_v_s->id,
                    'icon'        => '/uploads/cms/items/icon4.png',
                    'title'       => 'Global Reach',
                    'description' => "Serving organizations worldwide with scalable security solutions that adapt to any business size.",
                ],

            ]);
        }

        // === Contact Items ===
        $contact = CmsContent::where('page', Page::CONTACT->value)
            ->where('section', Section::SERVICES_SECTION->value)
            ->first();

        if ($contact) {
            CmsContentItem::insert([
                [
                    'content_id'  => $contact->id,
                    'icon'        => '/uploads/cms/items/gaurd.png',
                    'title'       => 'Certified Experts',
                    'description' => "Our team holds industry certifications including CISSP, CISM, CEH, and cloud security credentials.",
                ],
                [
                    'content_id'  => $contact->id,
                    'icon'        => '/uploads/cms/items/time.png',
                    'title'       => '24/7 Monitoring',
                    'description' => "Round-the-clock security operations center monitoring and incident response capabilities.",
                ],
                [
                    'content_id'  => $contact->id,
                    'icon'        => '/uploads/cms/items/message.png',
                    'title'       => 'Rapid Response',
                    'description' => "Emergency security incidents are addressed within 5 minutes of detection and alerting.",
                ],

            ]);
        }
    }
}
