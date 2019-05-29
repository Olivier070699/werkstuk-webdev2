<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Sponsor;
use App\Project;

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
}