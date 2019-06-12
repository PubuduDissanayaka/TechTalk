<?php

namespace App\Http\Controllers;

use App\NewsFeedComment;
use Illuminate\Http\Request;

class NewsFeedCommentController extends Controller
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
        $this->validate($request, array(
            'comment' => 'required|max:255',
            'user_id' => 'required',
            'feed_id' => 'required'
        ));

        $comment = new NewsFeedComment();

        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->feed_id = $request->feed_id;

        $comment->save();

        toastr()->success('Commented successfully!');

        // dd($request);
        // Notification::send($users, new NotifyBlogPostOwnerDB($comment));
        // Notification::route('mail', $users)->notify(new NotifyBlogPostOwner($comment));
        return redirect()->route('news-feed.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsFeedComment  $newsFeedComment
     * @return \Illuminate\Http\Response
     */
    public function show(NewsFeedComment $newsFeedComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsFeedComment  $newsFeedComment
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsFeedComment $newsFeedComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsFeedComment  $newsFeedComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsFeedComment $newsFeedComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsFeedComment  $newsFeedComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsFeedComment $newsFeedComment)
    {
        //
    }
}
