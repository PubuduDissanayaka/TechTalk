<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Event;
use App\Vacancy;
use App\Study;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('verified');
    }


    public function dashboard(){

        $blogs = BlogPost::all();
        $events = Event::all();
        $jobs = Vacancy::all();
        $studys = Study::all();
        // view('view.name', compact($data));

        return view('dashboard', compact('blogs','events','jobs','studys'));
    }
}
