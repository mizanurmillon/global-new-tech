<!-- sidebar  -->
@php
    $authUser = auth()->user();
@endphp
<nav id="sidebar" class="sidebar ">
    <!-- Logo  -->
    <div class="logo d-flex justify-content-center">
        <a class="large_logo" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset($systemSetting->logo ?? 'backend/assets/img/logo.png') }} " alt="" /></a>
        <a class="small_logo" href="{{ route('admin.dashboard') }}">
            <img class="rounded-circle" src="{{ asset($systemSetting->favicon ?? 'backend/assets/img/mini-logo.png') }}"
                alt="logo" style="object-fit: contain; height: 35px; width: 45px; margin-top: 5px;" />
        </a>

        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <li class="">
        <hr>
    </li>
    <ul id="sidebar_menu" class="mt-5">
        <li class="">
            <a href="/admin/dashboard" aria-expanded="false" class="active">
                <div class="nav_icon_small">
                    <i class="fas fa-home"></i>
                </div>
                <div class="nav_title">
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        @if ($authUser->role === 'admin')
            <li>
                <a href="/admin/team" aria-expanded="false" class="active">
                    <div class="nav_icon_small">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="nav_title">
                        <span>Team Members</span>
                    </div>
                </a>
            </li>
        @endif

        <li class="">
            <a href="/admin/brands" aria-expanded="false" class="active">
                <div class="nav_icon_small">
                    <i class="fas fa-building"></i>
                </div>
                <div class="nav_title">
                    <span>Brands</span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="/admin/technologies" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="fas fa-microchip"></i>
                </div>
                <div class="nav_title">
                    <span>Technologies</span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="/admin/testimonials" aria-expanded="false" class="active">
                <div class="nav_icon_small">
                    <i class="fas fa-quote-right"></i>
                </div>
                <div class="nav_title">
                    <span>Testimonials</span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="/admin/blogs" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="nav_title">
                    <span>Blogs</span>
                </div>
            </a>
        </li>
        @if ($authUser->role === 'admin')
            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div class="nav_title">
                        <span>Services</span>
                    </div>
                </a>
                <ul>
                    <li> <a href="/admin/services">Core Services</a> </li>
                    <li> <a href="/admin/sub-services">Sub Services</a> </li>
                    <li> <a href="/admin/compr-services">Comp Services</a> </li>

                </ul>
            </li>
        @endif

        {{-- <li class="">
            <a href="/admin/users" aria-expanded="false" class="active">
                <div class="nav_icon_small">
                    <i class="fas fa-users"></i>
                </div>
                <div class="nav_title">
                    <span>User Management</span>
                </div>
            </a>
        </li> --}}


        @if ($authUser->role === 'admin')
            <li class="">
                <a href="/admin/cms-contents" aria-expanded="false" class="active">
                    <div class="nav_icon_small">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <div class="nav_title">
                        <span>CMS</span>
                    </div>
                </a>
            </li>
        @endif
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="nav_title">
                    <span>Settings</span>
                </div>
            </a>
            <ul>
                <li> <a href="/admin/profile">Profile Settings</a> </li>
                <li> <a href="/admin/system-setting">System Settings</a> </li>
                {{-- <li> <a href="/admin/dynamic-page">Dynamic Page</a> </li> --}}
                <li> <a href="/admin/social-media">Social Settings</a> </li>
                <li> <a href="/admin/mail-setting">Mail Settings</a> </li>
            </ul>
        </li>
    </ul>
</nav>
<!--/ sidebar  -->
