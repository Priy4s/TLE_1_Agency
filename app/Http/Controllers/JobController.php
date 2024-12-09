<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JobController extends Controller
{
 public function show($id){

     $joblistings = JobListing::all ();

     $job = $joblistings->firstWhere('id',$id);

     return view ('detail.job', compact('job'));
 }

    public function manageDetails($id)
    {
        $job = JobListing::find($id);

        return view('components.manager.managedetails', compact('job'));
    }

}
