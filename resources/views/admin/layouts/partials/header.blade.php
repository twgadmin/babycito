<!-- BEGIN: Header-->

<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{!! auth()->user()->first_name . ' ' . auth()->user()->last_name !!}</span></div><span>
                                @if(auth()->user()->image != '' && file_exists(uploadsDir('admin') . auth()->user()->image ))
                                <img class="round" src="{!! asset(uploadsDir('admin') . auth()->user()->image) !!}" alt="avatar" height="40" width="40"></span>
                                @else
                                <img class="round" src="{!! asset('assets/admin/app-assets/images/portrait/small/avatar-s-11.jpg') !!}" alt="avatar" height="40" width="40"></span>
                                @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{!! route('admin.update-profile') !!}"><i class="feather icon-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;" onclick="logout()"><i class="feather icon-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">{{ config('app.name', 'Laravel') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                <a href="dashboard">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class=" navigation-header"><span>Modules</span>
            </li>   

            <li class=" nav-item {{ request()->segment(2) == 'payout' ? 'active' : '' }}">
                <a href="payout">
                    <i class="feather icon-dollar-sign"></i>
                    <span class="menu-title" data-i18n="payout">
                        Payout
                    </span>
                </a>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'administrators' ? 'active' : '' }}"> <a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Administrators</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'administrators' && request()->segment(3) == 'create') ? 'active' : '' }}"><a href="{{ route('admin.administrators.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'administrators' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.administrators.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <!-- <li class="nav-item {{ request()->segment(2) == 'media-files' ? 'active' : '' }}"><a href="#"><i class="feather icon-film"></i><span class="menu-title" data-i18n="Media player">Media Files</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.media-files.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'media-files' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.media-files.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li> -->

            <li class="nav-item {{ request()->segment(2) == 'users' ? 'active' : '' }}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="l18n">Users</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.users.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'users' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'vendors' ? 'active' : '' }}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="l18n">Vendors</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.vendors.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li><a href="{{ route('admin.banner.edit',1) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Edit Banner</span></a>
                    </li>
                    <li><a href="{{ route('admin.custom_services.create') }}"><i class="feather icon-plus-circle"></i><span class="menu-item" data-i18n="List">Add Services</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'vendors' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.vendors.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ request()->segment(2) == 'blogs' ? 'active' : '' }}"><a href="#"><i class="feather icon-rss"></i><span class="menu-title" data-i18n="l18n">Blogs</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.blogs.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'blogs' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.blogs.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'blog-categories' ? 'active' : '' }}"><a href="#"><i class="feather icon-type"></i><span class="menu-title" data-i18n="l18n">Blog Categories</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.blog-categories.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'blog-categories' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.blog-categories.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'featured-images' ? 'active' : '' }}"><a href="#"><i class="feather icon-image"></i><span class="menu-title" data-i18n="l18n">Featured Images</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.featured-images.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'featured-images' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.featured-images.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'testimonials' ? 'active' : '' }}"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="l18n">Testimonials</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.testimonials.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'testimonials' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.testimonials.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'category' ? 'active' : '' }}"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="l18n">Categories</span>
                </a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.category.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'category' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.category.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            
            <li class="nav-item {{ request()->segment(2) == 'faq' ? 'active' : '' }}"><a href="#"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="l18n">FAQ's</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'faq' && request()->segment(3) == 'create') ? 'active' : '' }}"><a href="{{ route('admin.faq.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'faq' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.faq.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ request()->segment(2) == 'pages' ? 'active' : '' }}"><a href="#"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="l18n">Pages</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'pages' && request()->segment(3) == 'create') ? 'active' : '' }}"><a href="{{ route('admin.pages.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add New</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'pages' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.pages.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'services' ? 'active' : '' }}"><a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="l18n">Home Page</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'services' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.services.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Listing</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->segment(2) == 'contact' ? 'active' : '' }}"><a href="#"><i class="feather icon-bell"></i><span class="menu-title" data-i18n="l18n">Contact Form</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'contact' && request()->segment(3) != 'create') ? 'active' : '' }}"><a href="{{ route('admin.contact.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Listing</span></a>
                    </li>
                </ul>
            </li>


            <li class="navigation-header"><span>Settings</span>
            </li>
            <li class="nav-item {{ request()->segment(2) == 'site-settings' ? 'active' : '' }}">
                <a href="{{ route('admin.site-settings.index') }}">
                    <i class="feather icon-settings"></i>
                    <span class="menu-title" data-i18n="Email">Site Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>