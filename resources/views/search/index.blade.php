@extends('layouts.app')

@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
{{-- sideBar --}}
<div class="d-flex align-items-stretch">
    {{-- <div id="sidebar" class="sidebar">
        @include('layouts._sidebar')
    </div> --}}
    {{-- end sideBar --}}

    {{-- page holder --}}
    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-4">
            <section class="py-3">
                <div class="row">
                    <div class="container">
                        {!! Form::open(['route' => 'search.action', 'data-parsley-validate'=> '', 'files'=> true]) !!}
                            <div class="col-xs-12">
                                <input type="text" id="search" placeholder="Search for...." class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="search" value="{{ old('search') }}" required autofocus>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-block waves-light waves-effect" type="submit">Search!</button>
                                </span>
                                    @if ($errors->has('search'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('search') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        {!!Form::close()!!}
                        {{-- <input type="text" name="search" id="search" class="form-control" placeholder="Search Anything..."> --}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills m-t-30 m-b-30" style="width:100%">
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Users</a> </li>
                                    <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Blog Posts</a> </li>
                                    <li class="nav-item"> <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="false">Events</a> </li>
                                    <li class="nav-item"> <a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="false">Jobs</a> </li>
                                    <li class="nav-item"> <a href="#navpills-5" class="nav-link" data-toggle="tab" aria-expanded="false">Study Plans</a> </li>
                                </ul><hr>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active" aria-expanded="true">
                                        <div class="row el-element-overlay">
                                            @if (isset($users))
                                            @foreach ($users as $user)
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="card">
                                                        <div class="el-card-item">
                                                            <div class="el-card-avatar el-overlay-1"> <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . $user->avatar)}}" alt="user">
                                                                <div class="el-overlay">
                                                                    <ul class="el-info">
                                                                        <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="el-card-content">
                                                                <h3 class="box-title">{{$user->name}} {{isset($user->last_name) ? $user->last_name : ""}}</h3>
                                                                {{-- <small>{{$user->detail->designation}}</small> --}}
                                                                <br> </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                            @else
                                                Find Users...
                                            @endif
                                        </div>
                                    </div>
                                    <div id="navpills-2" class="tab-pane" aria-expanded="false">
                                        @if (isset($blogs))
                                        <div class="row">
                                            @foreach ($blogs as $blog)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <img class="card-img-top" src="{{ asset('img/blog/cover/' . $blog->cover)}}" alt="Cover image">
                                                        <div class="card-body">
                                                            <a href="/blog-posts/{{$blog->title}}">
                                                                <h5 class="card-title">{{$blog->title}}</h5>

                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                            Find Blogposts...
                                        @endif
                                    </div>
                                    <div id="navpills-3" class="tab-pane" aria-expanded="false">
                                        <div class="">
                                            <div class="list-group">
                                                @if (isset($events))
                                                    @foreach ($events as $event)
                                                        <a href="/events/{{$event->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex justify-content-between">
                                                            <h5 class="mb-1">{{$event->title}}</h5>
                                                            <small>{{$event->created_at->diffForHumans()}}</small>
                                                            </div>
                                                            <p class="mb-1" style="text-align:justify">{{substr(strip_tags($event->description), 0, 100)}} {{ strlen($event->description) > 100 ? "..........." : "" }}</p>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    Find Events...
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="navpills-4" class="tab-pane" aria-expanded="false">
                                        <div class="">
                                            <div class="list-group">
                                                @if (isset($jobs))
                                                    @foreach ($jobs as $job)
                                                        <a href="/vacancy/{{$job->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex justify-content-between">
                                                            <h5 class="mb-1">{{$job->title}}</h5>
                                                            <small>{{$job->created_at->diffForHumans()}}</small>
                                                            </div>
                                                            <p class="mb-1" style="text-align:justify">{{substr(strip_tags($job->description), 0, 100)}} {{ strlen($job->description) > 100 ? "..........." : "" }}</p>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    Find Jobs...
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="navpills-5" class="tab-pane" aria-expanded="false">
                                        <div class="">
                                            <div class="list-group">
                                                @if (isset($studys))
                                                    @foreach ($studys as $study)
                                                        <a href="/study/{{$study->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex justify-content-between">
                                                            <h5 class="mb-1">{{$study->title}}</h5>
                                                            <small>{{$study->created_at->diffForHumans()}}</small>
                                                            </div>
                                                            <p class="mb-1" style="text-align:justify">{{substr(strip_tags($study->description), 0, 100)}} {{ strlen($study->description) > 100 ? "..........." : "" }}</p>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    Find Study Plans...
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

        {{-- end pageholder --}}

    </div>
</div>
@endsection

@section('script')
    <script>
        $().ready(function(){
            $('#search').focus();
        });
    </script>
@endsection





