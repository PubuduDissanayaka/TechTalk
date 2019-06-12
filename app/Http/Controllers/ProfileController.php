<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Friend;
use App\User;
use Auth;
use Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\NewsFeed;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // dd($user);

        $userid = $user->id;

        $friends = $user->friends();

        $feeds = $user->feeds;

        // $feeds = $feeds->orderBy('id', 'DESC')-get();

        // dd($user);
        // $allfeeds = DB::table('news_feeds')->where('user_id', '=', $user->id)->all();

        // $feeds = $allfeeds->filter(function($allfeeds, $userid) {
        //         // $user = User::find($id)->first();
        //         ($allfeeds->user_id == $userid)-all();
        // });


        return view('users.profile', compact('friends','user', 'feeds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function proPicUpload(Request $request){
        // validate data
        $this -> validate($request, array(
            'user_id' => 'required',
            'image' => 'mimetypes:image/jpeg,image/bmp,image/png',
        ));

        $user = User::find($request->user_id);

                //cover image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time(). '.' . $image->getClientOriginalExtension();
            // $location = public_path('storage/uploads/news-feeds/image/' . $filename);
            $location = public_path('storage/uploads/profiles/media/profile_pics/' . $filename);
            Image::make($image)->resize(150,150)->save($location);
            // Storage::putFileAs('public/uploads/profiles/media/profile_pics/', new File($image), $filename);

            $user->avatar = $filename;
        } else {

        }
        // dd($user);

        $user->save();

        toastr()->success('Your Profile Picture Updated successfully!');
        // return redirect()->route('news-feed.index');
        $friends = $user->friends();
        // return view('users.profile', compact('friends','user'));
        return redirect('/profile/'. $request->user_id);
    }
}
