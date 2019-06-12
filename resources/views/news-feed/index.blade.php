@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('kit/assets/plugins/dropzone-master/dist/dropzone.css')}}" />
    <link rel="stylesheet" href="{{asset('kit/assets/plugins/dropify/dist/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/parsley.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
{{-- sideBar --}}
<div class="d-flex align-items-stretch">
    {{-- end sideBar --}}

    {{-- page holder --}}
    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-4">
            <section class="py-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Create Post</h4></div>
                                <div class="card-body">
                                    {!! Form::open(['route' => 'news-feed.store', 'data-parsley-validate'=> '', 'files'=> true]) !!}
                                    <div class="form-group">
                                        <textarea id="my-textarea" class="form-control required" name="post" placeholder="What's on your mind, {{isset(Auth::user()->name) ? Auth::user()->name : " "}}?" name="" rows="5" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="dropimage">
                                                    <input type="file" name="image" id="dropimage" class="dropify"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="dropvideo">
                                                    <input type="file" name="video" id="dropvideo" class="dropify"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="attach btn btn-circle waves-effect waves-light btn-sm btn-primary"><i class="fas fa-paperclip"></i></button>
                                        <button type="button" class="image btn-rounded btn waves-effect waves-light btn-danger">
                                            <i class="far fa-image"> Image</i>
                                        </button>
                                        <button type="button" class="video btn btn-rounded waves-effect waves-light btn-warning">
                                            <i class="fas fa-video"></i> Video</i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{isset(Auth::user()->id) ? Auth::user()->id : ""}}" required>
                                    <input type="submit" class="btn btn-rounded btn-block btn-primary" value="Create Post" name="" id="">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="card">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="card-body">
                                            <div class="profiletimeline">
                                                @forelse ($feeds as $feed)
                                                    <div class="sl-item">
                                                        <div class="sl-left"> <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . $feed->user->avatar)}}" alt="user" width="60" class="img-circle" /> </div>
                                                        <div class="sl-right">
                                                            <div><a href="#" class="link">{{$feed->user->name}}</a> <span class="sl-date">{{$feed->created_at->diffForHumans()}}</span>
                                                                <p>{{$feed->post}}</p>
                                                                <div class="row">
                                                                    @if (isset($feed->image))
                                                                        <div class="col-md-12 m-b-20"><img src="{{asset('storage/uploads/news-feeds/media/image/'.$feed->image)}}" class="img-responsive radius " /></div>

                                                                    @endif
                                                                    @if (isset($feed->video))
                                                                        <div class="col-md-12">
                                                                            <video width="100%" controls>
                                                                                <source src="{{asset('storage/uploads/news-feeds/media/video/'.$feed->video)}}" type="video/mp4" style="dark">
                                                                                Your browser does not support HTML5 video.
                                                                            </video>
                                                                        </div>
                                                                    @endif
                                                                </div><br>
                                                                <div class="like-comm">
                                                                    <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                                    <button type="button" class="comment-btn btn btn-pimaryr m-r-10">2 comment</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 comment-area">
                                                                    {!! Form::open(['route' => 'feedcomments.store', 'data-parsley-validate'=> '', 'files'=> true]) !!}
                                                                    <textarea id="" rows="3" name="comment" required class="form-control required" placeholder="Type your comment..."></textarea>
                                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
                                                                    <input type="hidden" name="feed_id" value="{{$feed->id}}" required>
                                                                    <button type="submit" class="btn btn-block btn-primary waves-effect waves-light"><i class="fab fa-rocketchat"></i> Comment</button>
                                                                    {!!Form::close()!!}
                                                                    <br>
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($feed->comments as $com)
                                                                            <li class="media">
                                                                                <img class="d-flex mr-3" src="{{ asset('storage/uploads/profiles/media/profile_pics/' . $com->user->avatar)}}" width="35" alt="Generic placeholder image">
                                                                                <div class="media-body">
                                                                                    <p class="mt-0 mb-1">{{$com->user->name}} <small>{{$com->created_at->diffForHumans()}}</small></p>
                                                                                    <p>{{$com->comment}}</p>
                                                                                </div>
                                                                            </li>

                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                            {!! $feeds->links() !!}
                                                    </div>
                                                @empty
                                                    <h1 class="display-4">You dont have News Feeds</h1>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            {{-- <div class="card">
                                <div class="card-header">
                                    Header
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Title</h5>
                                    <p class="card-text">Content</p>
                                </div>
                                <div class="card-footer">
                                    Footer
                                </div>
                            </div> --}}
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
{{-- <script src="{{asset('kit/assets/plugins/dropzone-master/dist/dropzone.js')}}" type="text/javascript"></script> --}}
    <script src="{{asset('kit/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
    <script src="{{asset('kit/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/reaction/reaction.js')}}"></script>
    {{-- <script src="{{asset('kit/js/waves.js')}}"></script> --}}
<script>
    $(document).ready(function(){
        $('.image').hide();
        $('.video').hide();
        $('.attach').click(function(){
            $('.image').toggle('fast');
            $('.video').toggle('fast');
        });



        $(".comment-area").hide();
        $('.comment-btn').click(function(){
            $('.comment-area').slideToggle("fast");
        });

        // Basic
        // Used events
        $('#dropimage').dropify();
        $('#dropvideo').dropify();


        $('.dropimage').hide();
        $('.dropvideo').hide();

        $('.image').click(function(){
            $('.dropimage').slideToggle("fast");
        });

        $('.video').click(function(){
            $('.dropvideo').slideToggle("fast");
        });
    });
</script>
@endsection
