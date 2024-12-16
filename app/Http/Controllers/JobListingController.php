<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobListing;
use App\Models\Location;
use App\Models\Waitlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'drivers_license' => 'required|in:0,1',
            'starting_date' => 'required|date',
        ]);
        $validatedData['drivers_license'] = (bool) $validatedData['drivers_license'];
        JobListing::create($validatedData);

        return redirect()->route('manager.dashboard')->with('success', 'Job listing created successfully.');
    }

    // New create method to show the form
    public function create(): View
    {
        $locations = Location::all();
        $companies = Company::all();

        return view('jobs_listing.create', compact('locations', 'companies'));
    }

    public function myJobListings(): View
    {
        $userId = Auth::id();

        // Get all jobs the authenticated user has joined the waitlist for
        $waitlistedJobs = Waitlist::where('user_id', $userId)
            ->with('job') // Eager load the related job
            ->get();

        // Separate hired jobs and waiting jobs
        $hiredJobs = $waitlistedJobs->filter(function ($waitlist) {
            return $waitlist->status === 'hired';
        });

        $waitingJobs = $waitlistedJobs->filter(function ($waitlist) {
            return $waitlist->status === 'waiting';
        })->map(function ($waitlist) {
            // Add user's position and the waitlist count (only count 'waiting' statuses)
            $waitlist->position = Waitlist::where('job_id', $waitlist->job_id)
                ->where('status', 'waiting') // Filter for 'waiting' status only
                ->orderBy('created_at')
                ->pluck('user_id')
                ->search($waitlist->user_id) + 1; // Position in waitlist (1-indexed)

            $waitlist->waitlist_count = Waitlist::where('job_id', $waitlist->job_id)
                ->where('status', 'waiting') // Count only users with 'waiting' status
                ->count(); // Total waitlist count

            return $waitlist;
        });

        $jobListings = $hiredJobs->merge($waitingJobs); // Hired jobs first, followed by waiting jobs

        return view('jobs_listing.my-job-listings', compact('jobListings'));
    }

    public function managerDashboard(Request $request): View
    {
        $query = $request->input('query');
        $jobListings = JobListing::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('position', 'like', '%' . $query . '%')->orWhereHas('company', function ($companyQuery) use ($query) {
                $companyQuery->where('name', 'like', '%' . $query . '%');
            })->orWhereHas('location', function ($locationQuery) use ($query) {
                $locationQuery->where('name', 'like', '%' . $query . '%');
            });
        })->get();
        return view('components.manager.dashboard', compact('jobListings'));
    }
}
