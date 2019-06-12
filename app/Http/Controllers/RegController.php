<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Hash;

class RegController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->role_id = $request->acctype;
        $user->name = $request->fname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->last_name = $request->lname;

        $user->save();

        $getid = User::where('email', '=', $user->email)->get();
        $details = new UserDetail;

        $details->user_id = $getid[0]->id;
        $details->gender = $request->gender;
        $details->nic = $request->nic;
        $details->dob = $request->dob;
        $details->tel = $request->phone;
        $details->website = $request->website;
        $details->blog = $request->blog;
        $details->github = $request->github;

        $details->save();


        toastr()->success('Your Account Created Successfully! Check your email to activate and verify your account');
        return redirect('/login');

    }

    public function update(Request $request, $id){

        $user = User::find($request->user_id);
        $user->name = $request->fname;
        $user->last_name = $request->lname;

        // $user->update();

        $getid = UserDetail::where('user_id', '=', $request->user_id)->first();

        $getid->bio = $request->bio;
        $getid->designation = $request->designation;
        $getid->tel = $request->phone;
        $getid->website = $request->web;
        $getid->blog = $request->blog;
        $getid->github = $request->git;

        $getid->save();
        // dd($request);



        toastr()->success('Your Account Updated Successfully!');
        return redirect()->route('profile.show',$request->user_id);
    }

}
