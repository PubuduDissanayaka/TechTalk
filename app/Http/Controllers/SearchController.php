<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Study;
use App\BlogPost;
use App\Vacancy;
use App\Event;

class SearchController extends Controller
{
    public function index()
    {
            // $blogs = BlogPost::where('title', 'like', '%'.'Doloribus'.'%')
            //             ->orWhere('body', 'like', 'Doloribus')
            //             ->get();
            //             return $blogs;
        return view('search.index');

    }

    public function action(Request $request){
        // validate data
        $this -> validate($request, array(
            'search' => 'required|max:255'
        ));

        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $studys = Study::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('cover', 'LIKE', "%$keyword%")
                ->orWhere('photo', 'LIKE', "%$keyword%")
                ->orWhere('google', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('document', 'LIKE', "%$keyword%")
                ->get();
        } else {

        }

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->get();
        } else {

        }

        if (!empty($keyword)) {
            $blogs = BlogPost::where('title', 'LIKE', "%$keyword%")
                ->orWhere('body', 'LIKE', "%$keyword%")
                ->get();
        } else {

        }

        if (!empty($keyword)) {
            $jobs = Vacancy::where('title', 'LIKE', "%$keyword%")
                ->orWhere('details', 'LIKE', "%$keyword%")
                ->get();
        } else {

        }

        if (!empty($keyword)) {
            $events = Event::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('start', 'LIKE', "%$keyword%")
                ->orWhere('end', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->get();
        } else {

        }

        return view('search.index', compact('users','blogs','events','jobs', 'studys'));

        // return redirect()->route('search.index', compact('users','blogs','events','jobs', 'studys'));

    }
}
