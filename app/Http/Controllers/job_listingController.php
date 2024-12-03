<?php

namespace App\Http\Controllers;

use App\JobListing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class job_listingController extends Controller
{
    public function index(Request $request): Response
    {
        $jobListings = JobListing::all();

        return view('jobs_listing.index', compact('jobListings'));
    }
}
