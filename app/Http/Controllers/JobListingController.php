<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Company;
use App\Models\Location;

class JobListingController extends Controller
{
    // Existing index method
    public function index(Request $request): View
    {
        $jobListings = JobListing::all();
        $query = $request->input('query');

        $jobListings = JobListing::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('position', 'like', '%' . $query . '%')
                ->orWhereHas('company', function ($companyQuery) use ($query) {
                    $companyQuery->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('location', function ($locationQuery) use ($query) {
                    $locationQuery->where('name', 'like', '%' . $query . '%');
                });
        })->get();

        return view('jobs_listing.index', compact('jobListings'));
    }

    // Existing store method
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'position' => 'required|string',
            'description' => 'required|string',
            'length' => 'required|integer',
            'hours' => 'required|integer',
            'salary' => 'required|numeric',
            'type' => 'required|string',
            'location_id' => 'required|integer',
            'image' => 'string',
            'video' => 'string',
            'company_id' => 'required|integer',
            'needed' => 'required|integer',
            'driverslicense' => 'required|boolean',
        ]);
        JobListing::create($validatedData);

        return redirect()->route('job_listings.index')->with('success', 'Job listing created successfully.');
    }

    // New create method to show the form
    public function create(): View
    {
        // Return a view with the form to create a job listing
        $locations = Location::all(); // Fetch all locations
        $companies = Company::all(); // Fetch all companies

        return view('jobs_listing.create', compact('locations', 'companies'));
    }
}
