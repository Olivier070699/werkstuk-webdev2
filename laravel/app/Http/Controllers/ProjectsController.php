<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\User;
use App\Sponsor;
use App\Comment;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }


    public function show($id)
    {
        $project = Project::findOrFail($id);
        $creator = User::where('id', $project->user)->first();
        $sponsor = Sponsor::where('project_id', $id)->sum('credits');
        $comments = Comment::all()->where('project_id', $id);

        

        return view('projects.show', compact('project', 'creator', 'sponsor', 'comments'));
        
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


}
