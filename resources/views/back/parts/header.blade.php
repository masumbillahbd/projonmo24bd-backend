
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background: ;">

    <!-- <a class="navbar-brand" href=""> </a> -->

    <p class="navbar-brand" style="font-size: 18px;"><i style="color:#00ca00;"
                                                        class="fas fa-map-marker-alt"></i> {{Auth::user()->name}}</p>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <!--<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
		<div class="website_url">

        </div>
    </form>-->

    <div class="view_btn" style="">
        <a href="{{ url('/') }}" target="_blank" class="text-white">
            <i class="fas fa-globe"></i>
        </a>
    </div>

    <div class="top_menu form-inline ml-auto mr-0">
        <ul class="list-unstyled d-none d-lg-inline-flex d-md-inline-flex align-items-center justify-content-between">
            <li><a href="{{ route('breakingnews.index') }}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>Breaking</a></li>
            <li><a href="{{ route('post.create') }}" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Post</a></li>
            <li><a href="{{ route('post.index') }}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>View Posts
                </a></li>
            <li class="nav-item dropdown pt-">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    @if (!Auth::guest())
                        <span class="d-flex align-items-center">
                        <span class="avatar avatar-sm mr-md-2 ">
                            @if(!empty(Auth::user()->photo))
                                <img style="width:30px; height: 30px;border-radius: 50%;" title="{{Auth::user()->name}}"
                                     src="{{ asset('/profile/'.Auth::user()->photo)}}">
                            @else
                                <img width="30px" src="{{ asset('defaults/avatar01.png')}}">
                            @endif
                        </span>
                        <span class="d-none d-md-block">
                            <span class="d-block fw-500">{{Auth::user()->name}}</span>
                            <span style="opacity:0.7;"
                                  class="d-block small opacity-60">{{Auth::user()->user_type}}</span>
                        </span>
                    </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" style="padding: 0.5rem 1.5rem;" href="{{ route('user.profile.edit')}}"><i class="far fa-user"></i> Profile</a>
                    <a class="dropdown-item" style="padding: 0.5rem 1.5rem;" href="{{ route('user.change.password')}}"><i class="fa fa-key"></i> Change Password</a>

                    <a class="dropdown-item" style="padding: 0.5rem 1.5rem;" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>

    <!-- Navbar-->

<!--  <ul class="list-unstyled">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(!empty(Auth::user()->photo))
    <img style="width:30px; height: 30px;border-radius: 50%;" title="{{Auth::user()->name}}" src="{{ asset(Auth::user()->photo)}}">
                @else
    <img width="30px" src="{{ asset('defaults/avatar01.png')}}">
                @endif

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" target="_blank" href="{{ url('/')}}">View Site</a>
                {{--<a class="dropdown-item" href="{{ route('user.profile.edit',['id'=>Auth::user()->id])}}">Profile</a>--}}

        <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
        </form>
  </div>
</li>
</ul> -->
</nav>
