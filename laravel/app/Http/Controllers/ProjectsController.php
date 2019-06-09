<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\User;
use App\Sponsor;
use App\Comment;
use App\NewsOverview;
use App\Gift;
use App\Image;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $images = Image::all();
        return view('projects.index', compact('projects', 'images'));
    }


    public function show($id)
    {
        $project = Project::findOrFail($id);
        $creator = User::where('id', $project->user)->first();
        $sponsor = Sponsor::where('project_id', $id)->sum('credits');
        $comments = Comment::all()->where('project_id', $id);
        $images = Image::all()->where('project_id', $id);

        

        return view('projects.show', compact('project', 'creator', 'sponsor', 'comments', 'images'));
        
    }


    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $project = new Project();

        $project->title = request('title');
        $project->intro = request('intro');
        $project->description = request('description');
        $project->credits = request('credits');
        $project->user = \Auth::user()->id;


        $project->save();

        return redirect('/projects');
    }


    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }


    public function update($id)
    {
        $project = Project::findOrFail($id);

        $project->title = request('title');
        $project->intro = request('intro');
        $project->description = request('description');
        $project->credits = request('credits');

        $project->save();

        return redirect('/projects');

    }


    public function destroy($id)
    {
        Project::find($id)->delete();
        NewsOverview::where('project_id', $id)->delete();

        return redirect('/projects');
    }

    public function addCredits($id){
        $funded = request('numberOfCredits');

        if ($funded <= \Auth::user()->credits) {
            $sponsor = new Sponsor();
            $sponsor->project_id = $id;
            $sponsor->user_id = \Auth::user()->id;
            $sponsor->credits = $funded * 0.9;
            $sponsor->save();

            $newUserCredits = \Auth::user()->credits - $funded;
            User::where('id', \Auth::user()->id)->update([
                'credits' => $newUserCredits
            ]);

            $admin = User::where('id',2)->first();
            $adminCredits = $funded * 0.1;
            $newAdminCredits = $admin->credits + $adminCredits;
            User::where('id', $admin->id)->update([
                'credits' => $newAdminCredits
            ]);
            
            // Cadeau
            if($funded >= 200 && $funded < 500){
                $gift = new Gift();
                $gift->user_id = \Auth::user()->id;
                $gift->gift = 'Badeendje';
                $gift->save();
            }elseif($funded >= 500 && $funded < 700){
                $gift = new Gift();
                $gift->user_id = \Auth::user()->id;
                $gift->gift = 'Vip tafel';
                $gift->save();
            }elseif($funded >= 700){
                $gift = new Gift();
                $gift->user_id = \Auth::user()->id;
                $gift->gift = 'Vip tafel & 2 stukken chocolade';
                $gift->save();
            }

        }else {
            session()->flash("notif", "You don't have enough credits");
        }

        // Zie wat de cur user al gesponsord heeft
        // $showSponserdCredits = Sponsor::where('user_id', \Auth::user()->id)->sum('credits');
        // dd($showSponserdCredits);



        return redirect('/projects/'.$id );
    }

    public function addComment($id){
        $comment = new Comment();

        $comment->project_id = $id;
        $comment->user = \Auth::user()->name;
        $comment->comment = request('comment');

        $comment->save();

        return redirect('/projects/' . $id);
    }

    public function addNewsView($id){
        $project = Project::where('id',$id)->first();

        if (500 <= \Auth::user()->credits) {
        $news = new NewsOverview();
        $news->project_id = $id;
        $news->title = $project->title;
        $news->intro = $project->intro;

        $news->save();

        $cost = 500;

        $newUserCredits = \Auth::user()->credits - $cost;
        User::where('id', \Auth::user()->id)->update([
            'credits' => $newUserCredits
        ]);

        $admin = User::where('id',2)->first();
        $newAdminCredits = $admin->credits + $cost;
        User::where('id', $admin->id)->update([
            'credits' => $newAdminCredits
        ]);
        }else {
            session()->flash("notif", "You must have at least 500 credits");
        }
       


        return redirect('/projects/' . $id);
    }


}
