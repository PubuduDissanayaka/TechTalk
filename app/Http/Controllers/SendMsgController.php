<?php

namespace App\Http\Controllers;

use App\SendMsg;
use Illuminate\Http\Request;
use app\Chat;
use App\Notifications\MsgNotify;
use App\Notifications\MsgNotifyDB;
use Notification;
use Illuminate\Support\Facades\DB;

class SendMsgController extends Controller
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
        $chat = new Chat;
        $chat->user_id = $request->user_id;
        $chat->friend_id = $request->friend_id;
        $chat->chat = $request->chat;

        $chat->save();
        dd($request);

        $users = User::where('id', '=', $request->friend_id)->get();
        Notification::send($users, new MsgNotifyDB($chat));
        Notification::route('mail', $users)->notify(new MsgNotify($chat));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SendMsg  $sendMsg
     * @return \Illuminate\Http\Response
     */
    public function show(SendMsg $sendMsg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SendMsg  $sendMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(SendMsg $sendMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SendMsg  $sendMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendMsg $sendMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SendMsg  $sendMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendMsg $sendMsg)
    {
        //
    }
}
