@php $route = Route::currentRouteName();   @endphp

<div id="layoutSidenav_nav" >
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background: ;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!--<div class="sb-sidenav-menu-heading"></div>-->
                <a class="nav-link" href="{{ route('dashboard.admin.index')}}">
                    <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="1" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <rect x="10" y="12" width="4" height="4" />
                        </svg></div>
                    Dashboard
                </a>
                <a class="nav-link custom__link" href="{{ route('post.create') }}">
                    <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2.5" stroke="#FF9800" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></div>
                    Create New Post
                </a>

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin'|| Auth::user()->role == 'editor')
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSiteSetup" aria-expanded="false" aria-controls="collapseSiteSetup">
                        <div class="sb-nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="6" height="5" rx="2" />
                                <rect x="4" y="13" width="6" height="7" rx="2" />
                                <rect x="14" y="4" width="6" height="7" rx="2" />
                                <rect x="14" y="15" width="6" height="5" rx="2" />
                            </svg></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ $route=='prayertime.index' || $route=='general_setting.index'  || $route=='page.index' || $route=='page.create' || $route=='page.edit' || $route=='slider.create' || $route=='slider.edit' || $route=='slider.index'|| $route=='ramadan.create'|| $route=='ramadan.edit' ?'show':''}}" id="collapseSiteSetup" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            @if(Auth::user()->role == 'admin' ||Auth::user()->role == 'manager admin')
                            <a class="nav-link" href="{{ route('general_setting.index') }}"><i class="fa fa-genderless"></i>General Setting</a>
                            <a class="nav-link" href="{{ route('page.index') }}"><i class="fa fa-genderless"></i>Pages</a>
                            <a class="nav-link" href="{{ route('slider.index') }}"><i class="fa fa-genderless"></i>Slider</a>
                            @endif
                            <a class="nav-link" href="{{ route('prayertime.index') }}"><i class="fa fa-genderless"></i>Prayer Time</a>
                            <a class="nav-link" href="{{ route('ramadan.create') }}"><i class="fa fa-genderless"></i>Ramadan</a>
                        </nav>
                    </div>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin'|| Auth::user()->role == 'editor')
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdvertisement" aria-expanded="false" aria-controls="collapseAdvertisement">
                        <div class="sb-nav-link-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="6" height="5" rx="2" />
                                <rect x="4" y="13" width="6" height="7" rx="2" />
                                <rect x="14" y="4" width="6" height="7" rx="2" />
                                <rect x="14" y="15" width="6" height="5" rx="2" />
                            </svg></div>
                            Advertisement
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ $route=='popup.index'||$route=='popup.edit' || $route=='banner.index' ||$route=='innerAd.edit' || $route=='banner.edit' || $route=='ad.index' || $route=='innerAd.index' || $route=='ad.edit' ?'show':''}}" id="collapseAdvertisement" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('ad.index') }}"><i class="fa fa-genderless"></i>Ads Setup</a>
                            <a class="nav-link" href="{{ route('innerAd.index') }}"><i class="fa fa-genderless"></i>Inner Ads Setup</a>
                            <a class="nav-link" href="{{ route('banner.index') }}"><i class="fa fa-genderless"></i>Banner Setup</a>
                            <a class="nav-link" href="{{ route('popup.index') }}"><i class="fa fa-genderless"></i>Popup Ads Setup</a>
                        </nav>
                    </div>
                @endif



                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
                    <div class="sb-nav-link-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="4" width="6" height="5" rx="2" />
                            <rect x="4" y="13" width="6" height="7" rx="2" />
                            <rect x="14" y="4" width="6" height="16" rx="2" />
                        </svg></div>
                    Menu Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='menu.index'||$route=='menu.edit'||$route=='submenu.index'||$route=='submenu.edit'  ?'show':''}}" id="collapseMenu" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('menu.index') }}"><i class="fa fa-genderless"></i> Menu</a>
                        <a class="nav-link" href="{{ route('submenu.index') }}"><i class="fa fa-genderless"></i>Sub Menu</a>
                    </nav>
                </div>
                @endif


                @if(Auth::user()->role == 'admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-manual-gearbox" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="5" cy="6" r="2" />
                            <circle cx="12" cy="6" r="2" />
                            <circle cx="19" cy="6" r="2" />
                            <circle cx="5" cy="18" r="2" />
                            <circle cx="12" cy="18" r="2" />
                            <line x1="5" y1="8" x2="5" y2="16" />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <path d="M19 8v2a2 2 0 0 1 -2 2h-12" />
                        </svg>
                    </div>
                    Category Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{  $route=='category.index' || $route=='category.edit'||$route=='sub_category.index' || $route=='sub_category.edit'  ?'show':''}}" id="collapseCategory" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('category.index') }}"><i class="fa fa-genderless"></i>Categories</a>
                        <a class="nav-link" href="{{ route('sub_category.index') }}"><i class="fa fa-genderless"></i>Sub Categories</a>
                    </nav>
                </div>
                @endif


                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin'|| Auth::user()->role == 'editor'|| Auth::user()->role == 'user')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="false" aria-controls="collapseNews">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <polyline points="12 4 4 8 12 12 20 8 12 4" />
                            <polyline points="4 12 12 16 20 12" />
                            <polyline points="4 16 12 20 20 16" />
                        </svg></div>
                    News Manage
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{  $route=='featureTag.index'|| $route=='featureTag.edit'|| $route=='featureTagShow' || $route=='timeline.create' ||$route=='timeline.edit' || $route=='pushNotification.index' || $route=='post.schedule'|| $route=='post.schedule.show'|| $route=='post.schedule.edit'|| $route=='tag.index'|| $route=='tag.search'|| $route=='post.search'||$route=='trashpost.index'||$route=='trashpost.view'||$route=='products.filter'||$route=='post.user'||$route=='post.create'||$route=='post.index'||$route=='post.edit'||$route=='leadpost.index'|| $route=='leadpost.destroy'||$route=='breakingnews.index'||$route=='breakingnews.edit'||$route=='draft.index'||$route=='draft.edit'||$route=='post.filter'||$route=='readmore.index'||$route=='readmore.edit'?'show':''}}" id="collapseNews" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if(Auth::user()->role == 'user')
                        <a class="nav-link" href="{{ route('post.create') }}"><i class="fa fa-genderless"></i>Create Post</a>
                        <a class="nav-link" href="{{ route('post.user') }}"><i class="fa fa-genderless"></i>View All Posts</a>
                        <a class="nav-link" href="{{ route('draft.index') }}"><i class="fa fa-genderless"></i>Draft Posts</a>
                        @endif
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || Auth::user()->role == 'manager admin')
                        <a class="nav-link" href="{{ route('post.create') }}"><i class="fa fa-genderless"></i>Create Post</a>
                        <a class="nav-link" href="{{ route('post.index') }}"><i class="fa fa-genderless"></i>View All Posts</a>
                        <a class="nav-link" href="{{ route('leadpost.index') }}"><i class="fa fa-genderless"></i>Lead Posts</a>
                        <a class="nav-link" href="{{ route('post.schedule') }}"><i class="fa fa-genderless"></i>Schedule</a>
                        <a class="nav-link" href="{{ route('draft.index') }}"><i class="fa fa-genderless"></i>Draft Posts</a>
                        <a class="nav-link" href="{{ route('trashpost.index') }}"><i class="fa fa-genderless"></i>Trash Post</a>
                        <a class="nav-link" href="{{ route('breakingnews.index') }}"><i class="fa fa-genderless"></i>Breaking News</a>
                        <a class="nav-link" href="{{ route('readmore.index') }}"><i class="fa fa-genderless"></i>Read More</a>
                        <a class="nav-link" href="{{ route('tag.index') }}"><i class="fa fa-genderless"></i>Tag Managers</a>
                        <a class="nav-link" href="{{ route('featureTagShow') }}"><i class="fa fa-genderless"></i>Feature Tag Post</a>
                        <a class="nav-link" href="{{ route('timeline.create') }}"><i class="fa fa-genderless"></i>Timeline</a>
                        @endif
                        <a class="nav-link" href="{{ route('pushNotification.index') }}"><i class="fa fa-genderless"></i>Push Notification</a>
                    </nav>
                </div>
                @endif

                @if(Auth::user()->role == 'admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePoll" aria-expanded="false" aria-controls="collapsePoll">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="4" width="6" height="5" rx="2" />
                            <rect x="4" y="13" width="6" height="7" rx="2" />
                            <rect x="14" y="4" width="6" height="16" rx="2" />
                        </svg></div>
                    Online Survey
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='poll.create'||$route=='poll.index'||$route=='poll.edit'?'show':''}}" id="collapsePoll" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('poll.create') }}"><i class="fa fa-genderless"></i> Create</a>
                        <a class="nav-link" href="{{ route('poll.index') }}"><i class="fa fa-genderless"></i>Manage</a>
                    </nav>
                </div>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin'|| Auth::user()->role == 'editor')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePhoto" aria-expanded="false" aria-controls="collapsePhoto">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                            <circle cx="12" cy="13" r="3" />
                        </svg>
                    </div>
                    Photo Gallery
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='photo.index' || $route=='photo.create' || $route=='photo.edit'  ?'show':''}}" id="collapsePhoto" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('photo.create') }}"><i class="fa fa-genderless"></i>Create</a>
                        <a class="nav-link" href="{{ route('photo.index') }}"><i class="fa fa-genderless"></i>Manage</a>
                    </nav>
                </div>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin'|| Auth::user()->role == 'editor')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVideo" aria-expanded="false" aria-controls="collapseVideo">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-movie" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="4" width="16" height="16" rx="2" />
                            <line x1="8" y1="4" x2="8" y2="20" />
                            <line x1="16" y1="4" x2="16" y2="20" />
                            <line x1="4" y1="8" x2="8" y2="8" />
                            <line x1="4" y1="16" x2="8" y2="16" />
                            <line x1="4" y1="12" x2="20" y2="12" />
                            <line x1="16" y1="8" x2="20" y2="8" />
                            <line x1="16" y1="16" x2="20" y2="16" />
                        </svg>
                    </div>
                    Video Gallery
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='livestream' || $route=='video.index' || $route=='video.create' || $route=='video.edit'  ?'show':''}}" id="collapseVideo" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('video.create') }}"><i class="fa fa-genderless"></i>Create</a>
                        <a class="nav-link" href="{{ route('video.index') }}"><i class="fa fa-genderless"></i>Manage</a>
                        <a class="nav-link" href="{{ route('livestream') }}"><i class="fa fa-genderless"></i>Livestream</a>
                    </nav>
                </div>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="false" aria-controls="collapseReport">
                    <div class="sb-nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-analytics" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.0" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="9" y1="17" x2="9" y2="12" />
                            <line x1="12" y1="17" x2="12" y2="16" />
                            <line x1="15" y1="17" x2="15" y2="14" />
                        </svg></div>
                    Report
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='loginReport'||$route=='logoutReport'||$route=='userPostCountByDate'||$route=='user.post.report' || $route=='user.post.by.date' || $route=='pageviewreport'|| $route=='date.wise.view'?'show':''}}" id="collapseReport" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('user.post.report') }}"><i class="fa fa-genderless"></i>User Post</a>
                        <a class="nav-link" href="{{ route('pageviewreport') }}"><i class="fa fa-genderless"></i>Page View</a>
                        <a class="nav-link" href="{{ route('loginReport') }}"><i class="fa fa-genderless"></i>User Log</a>
{{--                        <a class="nav-link" href="{{ route('logoutReport') }}"><i class="fa fa-genderless"></i>Logout Data</a>--}}
                    </nav>
                </div>
                @endif

            @if(Auth::user()->role == 'admin')
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="false" aria-controls="collapseStaff">
                    <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stars" width="16" height="16" viewBox="0 0 24 24" stroke-width="1" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M17.8 19.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                            <path d="M6.2 19.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                            <path d="M12 9.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                        </svg></div>
                    Account
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $route=='reporter.index' ||$route=='reporter.edit' || $route=='admin.index' || $route=='admin.create' || $route=='admin.edit' || $route=='staff.index' || $route=='staff.create' || $route=='staff.edit' || $route=='role.index' || $route=='role.create' || $route=='role.edit'  ?'show':''}}" id="collapseStaff" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.index') }}"><i class="fa fa-genderless"></i>User Manage</a>
                        <a class="nav-link" href="{{ route('reporter.index') }}"><i class="fa fa-genderless"></i>Reporter Manage</a>
                    </nav>
                </div>
            @endif


                <div style="background: #041622;color: white;padding: 10px 0;">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="16" height="16" viewBox="0 0 24 24" stroke-width="1" stroke="#9b82ffd9" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg></div>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                    </form>
                </div>








            </div>
        </div>
    </nav>
</div>

