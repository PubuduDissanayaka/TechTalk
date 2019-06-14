<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{Auth::check() ? Auth::user()->id : 'null'}}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>TechTalk</title>
    @include('layouts._css')
    @yield('parsleystyle')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div id="app">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            {{-- <h3>TechTalk</h3> --}}
                            {{-- <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> --}}
                            <!-- Light Logo icon -->
                            {{-- <h3>TT</h3> --}}
                            {{-- <h3>TT</h3> --}}
                            <img src="{{asset('kit/assets/images/logo-light-iconmy.png')}}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         {{-- <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" /> --}}
                         <!-- Light Logo text -->
                         {{-- <h3>TechTalk</h3> --}}
                         <img src="{{asset('kit/assets/images/logo-textmy.png')}}" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    @guest

                    @else

                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item hidden-sm-down search-box">
                            <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter">
                                <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-search"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have {{count(Auth::user()->friend1->where('confirmed', '=', false))}} friend requests</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            @foreach (Auth::user()->friend1->where('confirmed', '=', false) as $friend1)
                                            <!-- Message -->
                                            <a href="#" class="hello">
                                                <div class="user-img"> <img src="{{asset('storage/uploads/profiles/media/profile_pics/' . $friend1->user1->avatar)}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>{{$friend1->user1->name}} {{isset($friend1->user1->laset_name) ? $friend1->user1->laset_name : ""}}</h5>
                                                    <div style="display: inline-block" data-userid="{{$friend1->user1->id}}">
                                                        <button class="waves-light btn btn-primary btn-sm request">Accept</button>
                                                        <button class="waves-light btn btn-danger btn-sm request">reject</button>
                                                    </div>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    @endguest
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    @guest

                    @else
                    <ul class="navbar-nav my-lg-0">

                        <!-- request -->
                        <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-users"></i>
                                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                </a>
                                <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                    <ul>
                                        <li>
                                            <div class="drop-title">You have {{count(Auth::user()->friend1->where('confirmed', '=', false))}} friend requests</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                                @foreach (Auth::user()->friend1->where('confirmed', '=', false) as $friend1)
                                                <!-- Message -->
                                                <a href="#" class="hello">
                                                    <div class="user-img"> <img src="{{asset('storage/uploads/profiles/media/profile_pics/' . $friend1->user1->avatar)}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>{{$friend1->user1->name}} {{isset($friend1->user1->laset_name) ? $friend1->user1->laset_name : ""}}</h5>
                                                        <div style="display: inline-block" data-userid="{{$friend1->user1->id}}">
                                                            <button class="waves-light btn btn-primary btn-sm request">Accept</button>
                                                            <button class="waves-light btn btn-danger btn-sm request">reject</button>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        <!-- ============================================================== -->
                        <!-- End Request -->
                        <!-- ============================================================== -->

                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Notifications -->
                        <!-- ============================================================== -->
                        <notification v-bind:notifications="notifications"></notification>
                        <!-- ============================================================== -->
                        <!-- End Notifications -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            @guest
                            @else
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if ((Auth::User()->avatar)===null)
                                    <img src="{{Voyager::image(app('VoyagerAuth')->user()->avatar)}}" class="profile-pic" alt="USER">
                                @else
                                    {{-- <img src="{{asset('img/avatar-6.png')}}" class="profile-pic" alt="USER"> --}}
                                    <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . Auth::user()->avatar)}}" class="profile-pic" alt="USER">
                                @endif
                            </a>
                            @endguest
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        @guest
                                        @else
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                                @if ((Auth::User()->avatar)===null)
                                                    <img src="{{Voyager::image(app('VoyagerAuth')->user()->avatar)}}" class="profile-pic" alt="USER">
                                                @else
                                                    {{-- <img src="{{asset('img/avatar-6.png')}}" class="profile-pic" alt="USER"> --}}
                                                    <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . Auth::user()->avatar)}}" class="profile-pic" alt="USER">
                                                @endif
                                            </div>
                                            <div class="u-text">
                                                <h4>{{isset(Auth::User()->name) ? Auth::User()->name : ""}} {{" "}} {{isset(Auth::User()->last_name) ? Auth::User()->last_name : ""}}</h4>
                                                @if ((Auth::User()->role_id) == 1)
                                                    <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "Admin")}}</p>
                                                @elseif((Auth::User()->role_id) == 2)
                                                    <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "Normal User")}}</p>
                                                @elseif((Auth::User()->role_id) == 3)
                                                    <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "IT Professional")}}</p>
                                                @elseif((Auth::User()->role_id) == 4)
                                                    <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "Company")}}</p>
                                                @elseif((Auth::User()->role_id) == 5)
                                                    <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "University")}}</p>
                                                @else

                                                @endif
                                                <p class="text-muted">{{(isset(Auth::User()->detail->designation) ? Auth::User()->detail->designation : "")}}</p>
                                                <br>
                                                <a href="/profile/{{isset(Auth::User()->id) ? Auth::User()->id : "not found"}}" class="btn btn-rounded waves-effect waves-light btn-danger btn-sm">View Profile</a></div>
                                        </div>

                                        @endguest
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/profile/{{isset(Auth::User()->id) ? Auth::User()->id : "not found"}}" class="waves-effect waves-light"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a data-toggle="tooltip" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Profile -->
                        <!-- ============================================================== -->
                    </ul>
                    @endguest
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        @guest
        @else
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(https://picsum.photos/200/500/?) no-repeat; cover;">
                    <!-- User profile image -->
                    <div class="profile-img">
                        @if ((Auth::User()->avatar)===null)
                            {{-- <img src="{{Voyager::image(app('VoyagerAuth')->user()->avatar)}}" class="profile-pic" alt="USER"> --}}
                        @else
                            <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . Auth::user()->avatar)}}" class="profile-pic" alt="USER">
                            {{-- <img src="{{asset('img/avatar-6.png')}}" class="profile-pic" alt="USER"> --}}
                        @endif
                        {{-- <img src="../assets/images/users/profile.png"  alt="user" /> --}}
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{isset(Auth::user()->name)? Auth::User()->name : ""}} {{" "}} {{isset(Auth::user()->laset_name)? Auth::User()->laset_name : ""}}</a>
                        <div class="dropdown-menu animated flipInX">
                            <a href="/profile/{{isset(Auth::User()->id) ? Auth::User()->id : "not found"}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a data-toggle="tooltip" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            {{-- <a data-toggle="tooltip" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a> --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">MENU</li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="/dashboard" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="/news-feed" aria-expanded="false"><i class="fas fa-newspaper    "></i><span class="hide-menu">News Feeds </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-light" href="#" aria-expanded="false"><i class="fas fa-blog"></i><span class="hide-menu">Blog Posts</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/blog-posts" class="waves-effect waves-light">All Posts</a></li>
                                <li><a href="/blog-posts/create" class="waves-effect waves-light">Create Post</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="#" aria-expanded="false"><i class="far fa-calendar-alt"></i><span class="hide-menu">Events</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/events" class="waves-effect waves-light">All Events</a></li>
                                <li><a href="/events/create" class="waves-effect waves-light">Create Event</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="#" aria-expanded="false"><i class="fas fa-user-tie"></i><span class="hide-menu">Job Market</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/vacancy" class="waves-effect waves-light">All Jobs</a></li>
                                <li><a href="/vacancy/create" class="waves-effect waves-light">Create Vacancy</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="#" aria-expanded="false"><i class="fas fa-graduation-cap"></i><span class="hide-menu">Study Plans</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="/study" class="waves-effect waves-light">All Plans</a></li>
                                <li><a href="/study/create" class="waves-effect waves-light">Create Program</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-light" href="/forums" aria-expanded="false"><i class="fab fa-forumbee"></i><span class="hide-menu">Forums</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a class="link" data-toggle="tooltip" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
                {{-- <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> --}}
            </div>
            <!-- End Bottom points-->
        </aside>
        @endguest
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                {{-- <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard 2</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard2</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <main>
                    @yield('content')
                </main>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018 - TechTalk
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    </div>
    @include('layouts._scripts')
</body>

</html>
