<?php
namespace App\Enum;

enum Page: string {

    case HOME     = 'home';
    case SERVICES = 'services';
    case ABOUT    = 'about';
    case BLOG     = 'blog';
    case PARTNER = 'partner';
    case CONTACT  = 'contact';
}
