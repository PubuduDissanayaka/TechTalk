@extends('layouts.app')

@section('css')
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=ck5lksam8dja2hvssb8hndfyhnd9qxvwobl1z6lxjuwyswym"></script>
{{-- <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script> --}}
<script>
    tinymce.init({
        selector:'#blogwrite',
        resize: false,
        plugins: 'link image table advlist autolink imagetools table spellchecker lists charmap print preview',
        contextmenu_never_use_native: true,
        plugins : 'advlist autolink table link image lists charmap print preview'
    });
</script>
<link rel="stylesheet" href="{{asset('kit/assets/plugins/dropify/dist/css/dropify.min.css')}}">
@endsection

{{-- @section('parsley.min.js')
    {!! Html::styles() !!}
@endsection --}}

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
<section class="">
    {!! Form::open(['route' => 'blog-posts.store', 'data-parsley-validate'=> '', 'files'=> true]) !!}
    <div class="row">
        <div class="col-sm-8 py-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="h6 text-uppercase mb-0 lead">Create New Blog Post</h3>
                </div>
                <div class="card-body">
                    <p>Share Your Knowledge with others....</p>
                    <form>
                    </form>
                    <label class="form-control-label text-uppercase">Title</label>
                    {{Form::text('title',null,array('class'=>"form-control form-control-lg", 'required' => '','maxlength'=>'255'))}}
                    <br>
                    <label class="form-control-label text-uppercase">Blog Description</label>
                    {{Form::textarea('description',null,array('class'=>"form-control", 'rows'=>'20', 'id'=>'blogwrite', 'required' => '' , 'placeholder'=>'Type event description'))}}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
            </div>
        </div>
        <div class="col-sm-4 py-2">
            <div class="card">
                <div class="card-header">
                    Blog Controller
                </div>
                <div class="card-body">
                    {{Form::submit('Create Blog Post',array('class'=>"btn btn-success form-control"))}}
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <label class="form-control-label text-uppercase">Catagory</label>
                </div>
                <div class="card-body">
                    <select name="cat_id" id="" class="form-control custom-select custom-select-lg">
                        @if (count($cat)>0)
                        <option selected>Select a Catagory from here..</option>
                        @foreach ($cat as $cat)
                            <option class="form-control" value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach

                        @else
                            <option>no catagory Found here</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <label class="form-control-label text-uppercase">Upload Cover Image</label>
                </div>
                <div class="card-body">
                  <p class="card-text">This will be shown as a Blog post cover image</p>
                  <input type="file" name="cover" class="form-control-file btn btn-outline-primary" id="">
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</section>
</div>

{{-- end pageholder --}}

</div>
</div>
@endsection

@section('script')
<script src="{{asset('kit/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('kit/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endsection
