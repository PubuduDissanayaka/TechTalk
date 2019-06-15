<?php

namespace App\Http\Controllers;

use App\UserProSkill;
use Illuminate\Http\Request;
use App\Skill;

class UserProSkillController extends Controller
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
        // validate data
        $this -> validate($request, array(
            'skill' => 'required',
            'user_id' => 'required',
            'institute' => '',
            'year' => 'required',
        ));

        $proskill = new UserProSkill;
        // $skillid = $request->skill;
        $icon = Skill::find($request->skill);
        // dd($icon);

        $proskill->user_id = $request->user_id;
        $proskill->skill_id = $request->skill;
        $proskill->institute = $request->institute;
        $proskill->year = $request->year;
        $proskill->icon = $icon->icon;

        $proskill->save();

        // redirect
        toastr()->success('Professional Skill Added successfully!');
        return redirect()->route('profile.show',$request->user_id);
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProSkill  $userProSkill
     * @return \Illuminate\Http\Response
     */
    public function show(UserProSkill $userProSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProSkill  $userProSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProSkill $userProSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProSkill  $userProSkill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProSkill $userProSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProSkill  $userProSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProSkill $userProSkill)
    {
        //
    }
}
