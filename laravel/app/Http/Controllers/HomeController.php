<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Sponsor;
use App\NewsOverview;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $overViews = NewsOverview::all();

        return view('home', compact('overViews'));
    }

    public function privacy(){
        return view('privacy');
    }

    public function profile(){
        $projects = Project::all();
        $sponsors = Sponsor::all();
        return view('profile', compact('projects', 'sponsors'));
    }
}
