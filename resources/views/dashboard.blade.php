@extends('layouts.app')

@section('content')
    {{-- sideBar --}}
<div class="d-flex align-items-stretch">
    {{-- <div id="sidebar" class="sidebar py-2">
        @include('layouts._sidebar')
    </div> --}}
    {{-- end sideBar --}}

    {{-- page holder --}}


    <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-info"><i class="fas fa-blog"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light">{{count($blogs)}}</h3>
                                        <h5 class="text-muted m-b-0">Total Blogs</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning"><i class="far fa-calendar-alt"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht">{{count($events)}}</h3>
                                        <h5 class="text-muted m-b-0">Total Events</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="fas fa-user-tie"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht">{{count($jobs)}}</h3>
                                        <h5 class="text-muted m-b-0">Total Jobs</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="fas fa-graduation-cap"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht">{{count($studys)}}</h3>
                                        <h5 class="text-muted m-b-0">Total Std. Plans</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img img-responsive" src="https://picsum.photos/50/50/?" height="50px" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile-first bg-over">
                                <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . Auth::user()->avatar)}}" class="img-circle" width="100">
                                <h4 class="card-title">{{Auth::user()->name}}</h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                <br><br>
                                    <div class="col">
                                        <h3 class="m-b-0">{{count(Auth::user()->friends())}}</h3>
                                        <h5 class="font-light">Friends</h5></div>
                                    <div class="col">
                                        <h3 class="m-b-0">420</h3>
                                        <h5 class="font-light">Following</h5></div>
                                    <div class="col">
                                        <h3 class="m-b-0">128</h3>
                                        <h5 class="font-light">Tweets</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="/blog-posts/create">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="round round-lg align-self-center round-danger"><i class="fas fa-blog"></i></div>
                                            <div class="m-l-10 align-self-center">
                                                <h3 class="m-b-0 font-light">Create Blog Post</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="/forums">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="round round-lg align-self-center round-warning"><i class="fab fa-forumbee"></i></div>
                                            <div class="m-l-10 align-self-center">
                                                <h3 class="m-b-0 font-light">Forum Discussions</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="/vacancy">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="round round-lg align-self-center round-info"><i class="fas fa-user-tie"></i></div>
                                            <div class="m-l-10 align-self-center">
                                                <h3 class="m-b-0 font-light">Job Market</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="/forums">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="round round-lg align-self-center round-success"><i class="fas fa-graduation-cap"></i></div>
                                            <div class="m-l-10 align-self-center">
                                                <h3 class="m-b-0 font-light">Study Plans</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
</div>
@endsection
