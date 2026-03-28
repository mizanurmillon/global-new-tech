<?php
namespace App\Enum;

enum Section: string {
    // home page
    case HERO_SECTION                   = 'hero_section';
    case ABOUT_SECTION                  = 'about_section';
    case SERVICES_SECTION               = 'services_section';
    case COMPREHENSIVE_SERVICES_SECTION = 'comprehensive_services_section';
    case TRUSTED_PARTNERS_SECTION       = 'trusted_partners_section';
    case TESTIMONIALS_SECTION           = 'testimonials_section';
    case BLOG_SECTION                   = 'blog_section';
    case NUMBER_SECTION                 = 'number_section';
    case OUR_STORY_SECTION              = 'our_story_section';
    case OUR_CORE_VALUES_SECTION        = 'our_core_values_section';
    case TEAM_SECTION                   = 'team_section';
    case CONTACT_SECTION                = 'contact_section';
    case SUB_FOOTER_SECTION             = 'sub_footer_section';
    case FOOTER_SECTION                 = 'footer_section';
}
