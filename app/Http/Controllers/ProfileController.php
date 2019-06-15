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
use App\Skill;
use Illuminate\Support\Facades\DB;
use UserProSkill;

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
        $user = User::findOrFail($id);
        $all = $user->stars;
        // $allvalues = DB::table('study_ratings')->where('study_id','=', $study->id)->get();
        $count =  $all->count();
        if ($count == 0) {
            $count += 1;
        } else {
            $count = $count;
        }
        $avarage = $all->pipe(function($all) {
            return $all->avg('value');
        });



        $five = $all->filter(function($all) {
                return $all->value == 5;
        });
        $numoffive = count($five);
        $fivepresentage = ($numoffive/$count) * 100;
        // dd($count);

        $four = $all->filter(function($all) {
                return $all->value == 4;
        });
        $numoffour = count($four);
        $fourpresentage = ($numoffour/$count) * 100;

        $three = $all->filter(function($all) {
                return $all->value == 3;
        });
        $numofthree = count($three);
        $threepresentage = ($numofthree/$count) * 100;

        $two = $all->filter(function($all) {
                return $all->value == 2;
        });
        $numoftwo = count($two);
        $twopresentage = ($numoftwo/$count) * 100;

        $one = $all->filter(function($all) {
                return $all->value == 1;
        });
        $numofone = count($one);
        $onepresentage = ($numofone/$count) * 100;
        // dd($fivepresentage);

        // return view('study.show', compact('study' , 'avarage', 'fivepresentage', 'fourpresentage', 'threepresentage' , 'twopresentage', 'onepresentage'));



        $userid = $user->id;

        $friends = $user->friends();

        $feeds = $user->feeds;

        $skills = Skill::all();

        $own = $user->skills;

        // dd($own);

        // if (isset($own)) {
        //     foreach($own as $o){
        //         return $o;
        //     };
        //     // $userskills = Skill::where('id', '=',  );
        // };

        return view('users.profile', compact('friends','skills','user', 'feeds' , 'avarage', 'fivepresentage', 'fourpresentage', 'threepresentage' , 'twopresentage', 'onepresentage'));
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
