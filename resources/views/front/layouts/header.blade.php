<header class="headerMain">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{!! route('public.index') !!}">
                <img class="logo" src="{!! asset('assets/frontend/images/logo.png') !!}" alt="BabyCito" />
            </a>
            <div class="header-right">
                <div class="header-wrap">

                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->segment(1) == '' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('public.index') !!}">home</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->segment(1) == 'providers' ? 'active' : '' }} {{ request()->segment(2) == 'how-providers-can-join' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">providers</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->segment(1) == 'providers' ? 'active' : '' }}" href="{!! route('providers') !!}">search providers</a>
                                <a class="dropdown-item {{ request()->segment(2) == 'how-providers-can-join' ? 'active' : '' }}" href="{!! asset('pages/how-providers-can-join') !!}">join as a provider</a>
                            </div>
                        </li>                  
                         <li class="nav-item">
                            <a class="nav-link" href="{!! route('find-registry') !!}">registry</a>
                        </li>                        
                        <li class="nav-item {{ request()->segment(2) == 'one-time-gifts' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! asset('pages/one-time-gifts') !!}">one-time gift</a>
                        </li>
                        <li class="nav-item {{ request()->segment(1) == 'help-center' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('help-center') !!}">FAQ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">learn more</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->segment(1) == 'blog' ? 'active' : '' }}" href="{!! route('blog') !!}">blog</a>
                                <a class="dropdown-item {{ request()->segment(1) == 'about-us' ? 'active' : '' }}" href="{!! route('about-us') !!}">about us</a>
                                <a class="dropdown-item {{ request()->segment(2) == 'education' ? 'active' : '' }}" href="{!! asset('pages/education') !!}">service education</a>
                                <a class="dropdown-item {{ request()->segment(1) == 'contact-us' ? 'active' : '' }}" href="{!! route('contact-us') !!}">contact us</a>
                            </div>
                        </li> 

                        @if(!Cart::isEmpty())
                        <li class="nav-item {{ request()->segment(1) == 'checkout' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('checkout') !!}"><i class="fa fa-shopping-cart"></i></a>
                        </li>
                        @endif

                    </ul>

                    <div class="header-search">
                        <i class="fa fa-search blog_search"></i>
                        <form class="searchDesktop"  action="{!! route('blog') !!}">
                            <input class="form-control" value="{{request()->q}}" name="q" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                </div>

                <div class="header-button-wrap">
                    @if (!auth()->user())
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#loginModal" class="button button-black">login</a>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#registerModal" class="button">sign up</a>
                    @else
                        <ul class="navbar-nav userbar">
                            <li class="nav-item dropdown">
                                <a  class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">
                                    <img class="user-img" src="{!! asset(uploadsDir('front/users_profile')) !!}/{{auth()->user()->profile_image}}" onerror="this.src='{{asset('assets/frontend/images/service.jpg')}}'" alt="" />
                                    <span class="user-title">{{auth()->user()->first_name}} {{auth()->user()->last_name}}<span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    @if(auth()->user()->user_type == 1)
                                    <a class="dropdown-item" href="{!! route('view-registry') !!}">View Registry</a>
                                    <a class="dropdown-item" href="{!! route('view-gifts') !!}">Gifts</a>
                                    @endif
                                    @if(auth()->user()->user_type == 2)
                                    <a class="dropdown-item" href="{!! route('service-listing') !!}">Provider Profile</a>
                                    @endif
                                    <a class="dropdown-item" href="{!! route('edit-user-password',auth()->user()->id) !!}">Change Password</a>
                                    <a class="dropdown-item" href="{!! route('edit-user',auth()->user()->id) !!}">Edit</a>
                                    <a class="dropdown-item" onclick="logout()">Logout</a>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </div>

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="divMobile">
                <div class="collapse navbar-collapse" id="navbarMobile">
                    <div class="sep10"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->segment(1) == '' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('public.index') !!}">home</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->segment(1) == 'providers' ? 'active' : '' }} {{ request()->segment(2) == 'how-providers-can-join' ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">providers</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->segment(1) == 'providers' ? 'active' : '' }}" href="{!! route('providers') !!}">search providers</a>
                                <a class="dropdown-item {{ request()->segment(2) == 'how-providers-can-join' ? 'active' : '' }}" href="{!! asset('pages/how-providers-can-join') !!}">join as a provider</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('find-registry') !!}">registry</a>
                        </li>
                        <li class="nav-item {{ request()->segment(2) == 'one-time-gifts' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! asset('pages/one-time-gifts') !!}">one-time gift</a>
                        </li>
                         <li class="nav-item {{ request()->segment(1) == 'help-center' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('help-center') !!}">faq</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">learn more</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->segment(1) == 'blog' ? 'active' : '' }}" href="{!! route('blog') !!}">blog</a>
                                <a class="dropdown-item {{ request()->segment(1) == 'about-us' ? 'active' : '' }}" href="{!! route('about-us') !!}">about us</a>
                                <a class="dropdown-item {{ request()->segment(2) == 'education' ? 'active' : '' }}" href="{!! asset('pages/education') !!}">service education</a>
                                <a class="dropdown-item {{ request()->segment(1) == 'contact-us' ? 'active' : '' }}" href="{!! route('contact-us') !!}">contact us</a>
                            </div>
                        </li> 
                        @if(!Cart::isEmpty())
                         <li class="nav-item {{ request()->segment(1) == 'checkout' ? 'active' : '' }}">
                            <a class="nav-link" href="{!! route('checkout') !!}">view cart</a>
                        </li>
                        @endif
                        @if (!auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#loginModal">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#registerModal">sign up</a>
                        </li>
                        @else
                            @if(auth()->user()->user_type == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('view-registry') !!}">view registry</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('view-gifts') !!}">gifts</a>
                            </li>
                            @endif
                            @if(auth()->user()->user_type == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('service-listing') !!}">provider profile</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('edit-user',auth()->user()->id) !!}">edit</a>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('edit-user-password',auth()->user()->id) !!}">change password</a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" onclick="logout()" href="javascript:;">logout</a>
                            </li>
                        @endif
                    </ul>
                    <form class="d-flex searchMobile" action="{!! route('blog') !!}">
                        <input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search" value="{{request()->q}}">
                        <button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </nav>
        
    </div>
</header>

<!-- Login Modal -->
<div class="modal fade modalbaby" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>I want to log in as a...</h5>
                <div class="buttonWrap">
                    <a class="button black" href="{!! route('login') !!}">Registry User</a>
                    <a class="button green" href="{!! route('providerlogin') !!}">Provider</a>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade modalbaby" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>I want to sign up as a...</h5>
                <div class="buttonWrap">
                    <a class="button black" href="{!! route('register') !!}">Registry User</a>
                    <a class="button green" href="{!! asset('pages/how-providers-can-join') !!}">Provider</a>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>