<?php

use App\Enum\Page;
use App\Enum\Section;

return [
    Page::HOME->value     => [
        Section::HERO_SECTION->value             => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => ['title', 'subtitle'],
        ],
        Section::ABOUT_SECTION->value            => [
            'fields' => ['title', 'subtitle'],
            'items'  => ['title', 'description', 'image'],
        ],
        Section::SERVICES_SECTION->value         => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::TRUSTED_PARTNERS_SECTION->value => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::BLOG_SECTION->value             => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::TESTIMONIALS_SECTION->value     => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::SUB_FOOTER_SECTION->value       => [
            'fields' => ['title', 'subtitle', 'button_text', 'button_link'],
            'items'  => [],
        ],
        Section::FOOTER_SECTION->value           => [
            'fields' => ['title', 'subtitle', 'image'],
            'items'  => [],
        ],
    ],

    Page::SERVICES->value => [
        Section::HERO_SECTION->value                   => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => [],
        ],
        Section::SERVICES_SECTION->value               => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::COMPREHENSIVE_SERVICES_SECTION->value => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::NUMBER_SECTION->value                 => [
            'fields' => ['title'],
            'items'  => ['title', 'subtitle'],
        ],
        Section::CONTACT_SECTION->value                => [
            'fields' => ['title', 'subtitle', 'image'],
            'items'  => [],
        ],

    ],

    Page::ABOUT->value    => [
        Section::HERO_SECTION->value             => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => [],
        ],
        Section::ABOUT_SECTION->value            => [
            'fields' => ['title'],
            'items'  => ['icon', 'title', 'description'],
        ],
        Section::NUMBER_SECTION->value           => [
            'fields' => ['title'],
            'items'  => ['title', 'subtitle'],
        ],
        Section::OUR_STORY_SECTION->value        => [
            'fields' => ['title', 'description', 'image'],
            'items'  => [],
        ],
        Section::OUR_CORE_VALUES_SECTION->value  => [
            'fields' => ['title', 'subtitle'],
            'items'  => ['icon', 'title', 'description'],
        ],
        Section::TEAM_SECTION->value             => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::TRUSTED_PARTNERS_SECTION->value => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
    ],

    Page::BLOG->value     => [
        Section::HERO_SECTION->value => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => [],
        ],
        Section::BLOG_SECTION->value => [
            'fields' => ['title'],
            'items'  => [],
        ],
    ],

    Page::CONTACT->value  => [
        Section::HERO_SECTION->value     => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => [],
        ],
        Section::CONTACT_SECTION->value  => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::SERVICES_SECTION->value => [
            'fields' => ['title'],
            'items'  => ['icon', 'title', 'description'],
        ],
    ],

    Page::PARTNER->value  => [
        Section::HERO_SECTION->value             => [
            'fields' => ['title', 'description', 'background_image'],
            'items'  => [],
        ],
        Section::TRUSTED_PARTNERS_SECTION->value => [
            'fields' => ['title', 'subtitle'],
            'items'  => [],
        ],
        Section::SUB_FOOTER_SECTION->value       => [
            'fields' => ['title', 'subtitle', 'button_text', 'button_link'],
            'items'  => [],
        ],
    ],
];
