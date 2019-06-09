<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Sponsor;
use App\NewsOverview;
use Carbon\Carbon;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $overViews = NewsOverview::all();
        $tomorrow = Carbon::tomorrow();
        $yesterday = Carbon::yesterday();
        

        return view('home', compact('overViews', 'yesterday', 'tomorrow'));
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
