<?php

namespace App\Http\Controllers;

use App\NewsFeed;
use Illuminate\Http\Request;
use Image;
use Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\NewsFeedComment;
use Illuminate\Pagination\LengthAwarePaginator;
use App\NewsFeedLike;
// use Illuminate\Support\Arr;


class NewsFeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $feeds= NewsFeed::all();
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3) {
        $feeds = NewsFeed::orderBy('id','desc')->paginate(20);
        return view('news-feed.index', compact('feeds'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // validate data
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3) {
            $this -> validate($request, array(
                'post' => 'required|max:255',
                'user_id' => 'required',
                'image' => 'mimetypes:image/jpeg,image/bmp,image/png',
                'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/x-matroska'

            ));

            $post = new NewsFeed;

            $post->post = $request->post;
            $post->user_id = $request->user_id;

            //cover image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time(). '.' . $image->getClientOriginalExtension();
                // $location = public_path('storage/uploads/news-feeds/image/' . $filename);
                Storage::putFileAs('public/uploads/news-feeds/media/image/', new File($image), $filename);

                $post->image = $filename;
            } else {

            }

            //cover video
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $filename = time(). '.' . $video->getClientOriginalExtension();
                // $location = public_path('storage/uploads/news-feeds/'. time() .'video/' . $filename);
                Storage::putFileAs('public/uploads/news-feeds/media/video/', new File($video), $filename);

                $post->video = $filename;
            } else {

            }

            $post->save();
            toastr()->success('Your Post Published successfully!');
            return redirect()->route('news-feed.index');
        }else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsFeed  $newsFeed
     * @return \Illuminate\Http\Response
     */
    public function show(NewsFeed $newsFeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsFeed  $newsFeed
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsFeed $newsFeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsFeed  $newsFeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsFeed $newsFeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsFeed  $newsFeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsFeed $newsFeed)
    {
        //
    }

    public function like(Request $request)
    {
        $like = new NewsFeedLike;

        $like->feed_id = $request->feed_id;
        $like->user_id = Auth::user()->id;
        $like->status = true;

        $like->save();

        return [
            'feed_id' => $request->feed_id
        ];
    }
}
