<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class jobListingController extends Controller
{
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
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'position' => 'required|string',
            'description' => 'required|text',
            'length' => 'required|integer',
            'hours' => 'required|integer',
            'minutes' => 'required|integer',
            'salary' => 'required|numeric',
            'type' => 'required|string',
            'location_id' => 'required|integer',
            'location' => 'required|string',
            'image' => 'required|text',
            'video' => 'required|string',
            'company_id' => 'required|integer',
            'company' => 'required|string',
            'needed' => 'required|boolean',
        ]);

        $jobListing = JobListing::create($validatedData);

        return redirect()->route('jobs_listing.index')->with('success', 'Job listing created successfully.');
    }
}
