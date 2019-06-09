<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Sponsor;
use App\Project;
use App\Image;

use DB;
use PDF;


class PdfGenerateController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($project_id)
    {
        $project = Project::where('id', $project_id)->first();

        $pdf = PDF::loadView('pdfview', array('project' => $project));
        return $pdf->download($project->title.'.pdf');
    }

    public function sponsorpdfview()
    {
        $sponsors = Sponsor::all()->where('user_id', \Auth::user()->id);
        // dd($sponsors);

        $pdf = PDF::loadView('generate-sponsor-pdf', array('sponsors' => $sponsors));
        return $pdf->download(\Auth::user()->name . '_sponserd.pdf');
    }

    public function seeyoursponsorpdfview($project_id)
    {
        $sponsors = Sponsor::all()->where('project_id', $project_id);
        // dd($sponsors);

        $pdf = PDF::loadView('yoursponsors', array('sponsors' => $sponsors));
        return $pdf->download('Your_sponsors.pdf');
    }
}