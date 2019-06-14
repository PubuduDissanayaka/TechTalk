<?php

namespace App\Http\Controllers;

use App\Friend;
use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('verified');
    }

        /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd($friend);
        $friends = Auth::user()->friend1->where('confirmed', '=', true);
        // dd($friends);
        return view('friends.index')->with('friends',$friends);
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
        // $friend = Friend::all()->where('user_id', '=', Auth::user()->id)->where('friend_id', '=' , 23)->first();
            $friend = new Friend;

            $friend->user_id = Auth::user()->id;
            $friend->friend_id = $request->friend_id;
            // $friend->confirmed = 0;

            $friend->save();

            return [
                'friend_id' => $request->friend_id
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }

    public function remove(Request $request)
    {

        $friend = Friend::all()->where('user_id', '=', Auth::user()->id)->where('friend_id', '=' , $request->friend_id)->first();
        // dd($friend);
        $friend->delete();

        return [
            'friend_id' => Auth::user()->id
        ];
    }

    public function request(Request $request)
    {
       $user = Friend::all()->where('friend_id', '=' , Auth::user()->id)->where('user_id', '=', $request->user_id)->first();
        if ($request->isRequest) {
            $user->confirmed = true;

            $user->save();
            return [
                'user_id' => $request->user_id,
                'true' => true
            ];
        }

        $user->delete();
        return [
            'user_id' => $request->user_id,
            'true' => false
        ];
    }
}
