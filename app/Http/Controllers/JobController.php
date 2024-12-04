<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
 public function show($id){

     $joblistings = JobListing::all ();

     $job = $joblistings->firstWhere('id',$id);

     return view ('detail.job', compact('job'));
 }
}
