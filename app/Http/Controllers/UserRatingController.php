<?php

namespace App\Http\Controllers;

use App\UserRating;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\NotyfyUserRating;
use App\Notifications\NotyfyUserRatingDB;
use Illuminate\Support\Facades\DB;
use App\User;

class UserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this -> validate($request, array(
            'values' => 'required',
            'feedback' => '',
            'rating_user_id' => 'required',
            'user_id' => 'required',
            'star_status' => 'required'
        ));

        $userRating = new UserRating;

        $userRating->value = $request->values;
        $userRating->feedback = $request->feedback;
        $userRating->user_id = $request->user_id;
        $userRating->rating_user_id = $request->rating_user_id;
        $userRating->star_status = $request->star_status;

        $userRating->save();

        $user = User::find($request->user_id);

        // send notifications
        $users = User::find($userRating->user_id);
        // dd($request);
        // dd($users);
        // Notification::send($users, new NotyfyUserRatingDB($userRating));
        // Notification::route('mail', $users)->notify(new NotyfyUserRating($userRating));

        // redirect
        toastr()->success('User Rated successfully!');
        return redirect()->route('profile.show',$users->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRating  $userRating
     * @return \Illuminate\Http\Response
     */
    public function show(UserRating $userRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRating  $userRating
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRating $userRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRating  $userRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRating $userRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRating  $userRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRating $userRating)
    {
        //
    }
}
