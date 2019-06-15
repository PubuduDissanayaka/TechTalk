@extends('layouts.app')

@section('css')
<style>

</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
<link href="/css/star/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
<script src="/js/star/star-rating.js" type="text/javascript"></script>
<link href="/css/star/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('kit/assets/plugins/dropify/dist/css/dropify.min.css')}}">
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
<section>
    <div class="row py-3">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30" data-friendid="{{$user->id}}" >
                        @if (isset($user->avatar))
                            {{-- <img src="{{ asset('storage/uploads/avatars/default.png')}}"  alt="USER" width="150"> --}}
                            <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . $user->avatar)}}" alt="USER" class="img-circle" width="150"><br>
                        {{-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150"> --}}
                        @else
                        @endif
                        <br>

                        @if ((Auth::user()->id) == $user->id)
                        <div class="div propicchange">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#propicModal" data-whatever="@mdo">Change Profile Picture</button>
                        </div><br>
                        @else


                        @if (Auth::check())
                            @php
                                $i = $friends->count();
                                $c = 1;
                            @endphp
                            @foreach ($friends as $friend)
                                @if ($friend->id == $user->id)
                                    <div data-friendid="{{$user->id}}">
                                        {{-- <button data-friendid="{{$user->id}}" type="button" class="waves-light btn btn-block btn-info friend">Send Friend Request*</button> --}}
                                    </div>
                                    @break
                                @elseif($i == $c)
                                    <button data-friendid="{{$user->id}}" type="button" class="waves-light btn btn-block btn-danger remove">Unfriend</button>
                                @endif
                                @php
                                    $c++;
                                @endphp
                            @endforeach

                            @if ($i == 0)
                                <button data-friendid="{{$user->id}}" type="button" class="waves-light btn btn-block btn-info friend">Send Friend Request</button>
                            @endif
                        @endif

                        <br>
                        <div>
                            <button type="button" id="#message" data-toggle="modal" data-whatever="@mdo" class="waves-light btn btn-block btn-warning">Send Message</button>
                        </div>
                        @endif
                        <h4 class="card-title m-t-10">{{$user->name}} {{isset($user->laset_name) ? $user->laset_name : ""}}</h4>
                        <h6 class="card-subtitle">{{isset($user->detail->designation) ? $user->detail->designation : "Your Designation"}}</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">{{count($user->friends())}}</font></a></div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="far fa-newspaper"></i> <font class="font-medium">{{count($feeds)}}</font></a></div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>{{{$user->email}}}</h6>
                    @if (($user->role_id)== 4 || ($user->role_id)== 5)
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{$user->detail->tel}}</h6>
                    @else

                    @endif
                    <br>
                    @if ((($user->detail->website) == "" || ($user->detail->blog)=="" || ($user->detail->github)==""))
                    @else
                        <small class="text-muted p-t-30 db">Social Profile</small>
                    @endif
                    @isset($user->detail->website)
                        <a href="{{$user->detail->website}}" target="_blank" class="btn btn-circle btn-primary"><i class="fas fa-globe"></i></a>
                    @endisset
                    @isset($user->detail->blog)
                        <a href="{{$user->detail->blog}}" target="_blank" class="btn btn-circle btn-warning"><i class="fab fa-blogger-b"></i></a>
                    @endisset
                    @isset($user->detail->github)
                        <a href="{{$user->detail->github}}" target="_blank" class="btn btn-circle btn-info"><i class="fab fa-github"></i></a>
                    @endisset
                </div>
                <hr>

                {{-- star rating form --}}
                <div class="col-md-12">
                    {!! Form::open(['route' => 'userrating.store', 'data-parsley-validate'=> '', 'files'=> true]) !!}
                        <input id="study" name="values" required class="rating rating-loading" value="" data-min="0" data-max="5" data-step="1" data-size="lg">
                        <br>
                        <div class="col-md-9">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input id="customRadioInline1" type="radio" name="star_status" value="positive" class="custom-control-input">
                                <label for="customRadioInline1" class="custom-control-label">Positive</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input id="customRadioInline2" type="radio" name="star_status" value="negative" class="custom-control-input">
                                <label for="customRadioInline2" class="custom-control-label">Negative</label>
                            </div>
                        </div>
                        <textarea class="form-control" name="feedback" id=""rows="4"></textarea>
                        <br>
                        <input type="text" hidden required value="{{Auth::user()->id}}" name="rating_user_id">
                        <input type="text" hidden required value="{{$user->id}}" name="user_id">
                        <button type="submit" class="btn btn-warning btn-block btn-sm">Submit</button><br>
                        <input type="reset" value="Clear" class="btn btn-block btn-danger btn-sm">
                    {!! Form::close() !!}
                </div><br>
                {{-- end star rating form --}}
            </div>
        </div>

        <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card card-outline-success">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="display-4 d-flex justify-content-center clearfix">{{round($avarage,1)}}</div>
                                <p class="studycountusrestar"><i class="fa fa-user-o" aria-hidden="true"></i> {{count($user->stars)}}</p>
                                <input id="show" name="values" class="rating clearfix rating-loading d-inline" value="{{round($avarage,1)}}" data-min="0" data-max="5" data-step="0.5" readonly data-size="sm">
                            </div>

                            <div class="col-md-8">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$fivepresentage}}%" aria-valuenow="{{$fivepresentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: {{$fourpresentage}}%" aria-valuenow="{{$fourpresentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$threepresentage}}%" aria-valuenow="{{$threepresentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$twopresentage}}%" aria-valuenow="{{$twopresentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{$onepresentage}}%" aria-valuenow="{{$onepresentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                            </div>

                        </div>
                        {{-- add skills --}}
                        @if (((Auth::user()->id)== $user->id) && (($user->id == 3 || $user->id) == 1 || $user->id) == 2))
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addskills">
                                Add Professional Skills
                            </button>
                        @endif
                            <br><br>
                        @forelse ($user->skills as $item)
                            <div class="profile-img" style="display:inline-block">
                                <img src="{{ asset('storage/uploads/skill_badges/' . $item->icon)}}" width="108px" alt="USER" class="profile-pic">
                            </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            @if ((Auth::user()->id)== $user->id)
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
            @else

            @endif
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">

                                @forelse ($feeds as $feed)
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('storage/uploads/profiles/media/profile_pics/' . $feed->user->avatar)}}" alt="user" class="img-circle">
                                        </div>
                                        <div class="sl-right">
                                            <div><a href="#" class="link">{{$feed->user->name}}</a> <span class="sl-date">{{$feed->created_at->diffForHumans()}}</span>
                                                <p>{{$feed->post}}</p>
                                                <div class="row">
                                                    @if (isset($feed->image))
                                                        <div class="col-md-12 m-b-20"><img src="{{asset('storage/uploads/news-feeds/media/image/'.$feed->image)}}" class="img-responsive radius" /></div>

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
                                                    <button type="button" class="comment-btn btn btn-pimaryr m-r-10">2 comment</button>
                                                    <a href="javascript:void(0)" class="link m-r-10">
                                                        <i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                </div>
                                            </div>
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
                                        </div>
                                    </div>

                                @empty

                                @endforelse
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!--second tab-->
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">{{$user->name}} {{" "}} {{isset($user->last_name) ? $user->last_name : " "}}</p>
                                </div>
                                @if (($user->role_id)== 4 || ($user->role_id)== 5))
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                        <br>
                                        @isset($user->detail->tel)
                                            <p class="text-muted">{{$user->detail->tel}}</p>

                                        @endisset
                                    </div>
                                @else

                                @endif
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">{{$user->email}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6"> <strong>Designation</strong>
                                    <br>
                                    <p class="text-muted">{{isset($user->detail->designation) ? $user->detail->designation : ""}}</p>
                                </div>
                            </div>
                            <hr>
                            <h5>Bio</h5>
                            <p class="m-t-10">{{isset($user->detail->bio) ? $user->detail->bio : "*** "}}</p>
                            <h4 class="font-medium m-t-30">Skill Set</h4>
                            <hr>
                            <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                            <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel">

                        <div class="card-body">
                        @if ((Auth::user()->id) == $user->id)
                            {!! Form::open(['route' => ['register-user.update',$user->id], 'data-parsley-validate'=> '', 'files'=> true]) !!}
                                {{Form::hidden('_method','PUT')}}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fname">First Name:</label>
                                        <input id="fname" class="form-control" type="text" value="{{isset($user->name) ? $user->name : ""}}" name="fname">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lname">Last Name:</label>
                                        <input id="lname" class="form-control" value="{{isset($user->last_name) ? $user->last_name : ""}}" type="text" name="lname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="desig">Designation:</label>
                                        <input id="desig" class="form-control" value="{{isset($user->detail->designation)? $user->detail->designation :""}}" type="text" name="designation">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Contact No:</label>
                                        <input id="phone" class="form-control" value="{{isset($user->detail->tel) ? $user->detail->tel : ""}}" type="text" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="web">Website:</label>
                                        <input id="web" class="form-control" value="{{isset($user->detail->website)? $user->detail->website : ""}}" type="url" name="web">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="git">GitHub:</label>
                                        <input id="git" class="form-control" type="url" value="{{isset($user->detail->github) ? $user->detail->github : ""}}" name="git">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="blog">BlogSite:</label>
                                        <input id="blog" class="form-control" type="url" value="{{isset($user->detail->blog) ? $user->detail->blog : ""}}" name="blog">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="bio">Bio:</label>
                                        <textarea id="bio" class="form-control" value="{{isset($user->detail->bio) ? $user->detail->bio : ""}}" name="bio" rows="15"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" class="btn btn-primary waves-light btn-block" value="Update Profile">
                            </div>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            {!! Form::close() !!}
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- The Modal -->
<div class="modal fade" id="propicModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Profile Picture</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            {!! Form::open(['route' => 'upload.propic', 'data-parsley-validate'=> '', 'files'=> true]) !!}
            <div class="row">
                <div class="col md-12">
                    <div class="form-group">
                        <div class="dropzone">
                            <input type="file" required name="image" id="dropzone" class="dropify"/>
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="submit" value="Upload" class="btn btn-block waves-light btn-primary">
                </div>
            </div>
            {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>


{{-- message model --}}
<div class="modal fade" id="message">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">send Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            {!! Form::open(['route' => 'chat.send', 'data-parsley-validate'=> '', 'files'=> true]) !!}
            <div class="row">
                <div class="col md-12">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <input type="text" hidden name="friend_id" value="{{$user->id}}" required>
                        <input type="text" hidden name="user_id" value="{{Auth::user()->id}}" required>
                        <textarea id="message" required class="form-control" name="chat" rows="3"></textarea>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>
{{-- end message model --}}


{{-- add skills --}}
<div class="modal fade" id="addskills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Professional Skills</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'addskills.store', 'data-parsley-validate'=> '', 'files'=> true]) !!}
            <div class="row">
                <div class="col md-12">
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <select id="skills" class="custom-select" name="skill" required>
                            <option selected>Select from here...</option>
                            @foreach ($skills as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                            @endforeach
                            {{-- <option value="">2</option> --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="institute">Institute name:</label>
                        <input id="institute" class="form-control" type="text" name="institute">
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input id="year" required placeholder="YYYY" class="form-control" name="year" type="text">
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Skill</button>
            </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
{{-- end add skills --}}
</section>
</div>


{{-- end pageholder --}}

</div>
</div>
@endsection

@section('script')
<script src="{{asset('kit/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('#dropimage').dropify();
    $('#dropvideo').dropify();

     $('.image').hide();
        $('.video').hide();
        $('.attach').click(function(){
            $('.image').toggle('fast');
            $('.video').toggle('fast');
        });

        // Basic
        // Used events
        $('.dropimage').hide();
        $('.dropvideo').hide();

        $('.image').click(function(){
            $('.dropimage').slideToggle("fast");
        });

        $('.video').click(function(){
            $('.dropvideo').slideToggle("fast");
        });



        $('#dropzone').dropify();

        $(".comment-area").hide();
        $('.comment-btn').click(function(){
            $('.comment-area').slideToggle("fast");
        });



});
</script>
<script>
$(document).on('ready', function(){
    $('#study').rating();
    }
});
$(document).on('ready', function(){
    $('#show').rating();
    }
});
</script>
@endsection
