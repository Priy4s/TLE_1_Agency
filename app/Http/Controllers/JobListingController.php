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
    public function index(Request $request): View
    {
        if (Auth::user()->role === 'admin') {
            // Fetch all job listings if the user is an admin
            $jobListings = JobListing::all();
            return view('components.manager.dashboard', ['jobListings' => $jobListings]);
        }

        // Get the search query and sort parameters from the request
        $query = $request->input('query');
        $sort = $request->input('sort'); // The sorting parameter: "salary_asc" or "salary_desc"

        // Start the query builder for JobListings
        $jobListings = JobListing::query();

        // Apply search filter if there is a query input
        if ($query) {
            $jobListings = $jobListings->where('position', 'like', '%' . $query . '%')
                ->orWhereHas('company', function ($companyQuery) use ($query) {
                    $companyQuery->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('location', function ($locationQuery) use ($query) {
                    $locationQuery->where('name', 'like', '%' . $query . '%');
                });
        }

        // Apply sorting by salary if the 'sort' parameter is present
        if ($sort === 'salary_asc') {
            $jobListings = $jobListings->orderBy('salary', 'asc');
        } elseif ($sort === 'salary_desc') {
            $jobListings = $jobListings->orderBy('salary', 'desc');
        }

        // Execute the query to get the results
        $jobListings = $jobListings->get();

        // Return the view with the job listings
        return view('jobs_listing.index', compact('jobListings'));
    }




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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|video|mimes:mp4,mov,avi,wmv,flv|max:2048',
            'needed' => 'required|integer',
            'drivers_license' => 'required|in:0,1',
            'starting_date' => 'required|date',
        ]);

        $validatedData['drivers_license'] = (bool) $validatedData['drivers_license'];

        $validatedData['company_id'] = Auth::user()->company_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('job_videos', 'public');
            $validatedData['video'] = $videoPath;
        }

        JobListing::create($validatedData);

        return redirect()->route('manager.dashboard')->with('success', 'Job listing created successfully.');
    }

    public function create(): View
    {
        if (Auth::user()->role !== 'admin') {
            // Haal de joblistings op
            $jobListings = JobListing::all(); // Let op de naam: $jobListings

            return view('jobs_listing.index', ['jobListings' => $jobListings]);
        }

        $locations = Location::all();
        $companies = Company::all();

        return view('jobs_listing.create', compact('locations', 'companies'));
    }

    public function myJobListings(): View
    {
        if (Auth::user()->role === 'admin') {
            // Haal de joblistings op
            $jobListings = JobListing::all(); // Let op de naam: $jobListings

            return view('components.manager.dashboard', ['jobListings' => $jobListings]);
        }

        $userId = Auth::id();

        $waitlistedJobs = Waitlist::where('user_id', $userId)
            ->with('job')
            ->get();

        $hiredJobs = $waitlistedJobs->filter(function ($waitlist) {
            return $waitlist->status === 'hired';
        });

        $waitingJobs = $waitlistedJobs->filter(function ($waitlist) {
            return $waitlist->status === 'waiting';
        })->map(function ($waitlist) {
            $waitlist->position = Waitlist::where('job_id', $waitlist->job_id)
                ->where('status', 'waiting') // Filter for 'waiting' status only
                ->orderBy('created_at')
                ->pluck('user_id')
                ->search($waitlist->user_id) + 1; // Position in waitlist (1-indexed)


            $waitlist->waitlist_count = Waitlist::where('job_id', $waitlist->job_id)
                ->where('status', 'waiting')
                ->count();

            return $waitlist;
        });

        $jobListings = $hiredJobs->merge($waitingJobs);

        return view('jobs_listing.my-job-listings', compact('jobListings'));
    }

    public function managerDashboard(Request $request): View
    {
        if (Auth::user()->role !== 'admin') {
            // Haal de joblistings op
            $jobListings = JobListing::all(); // Let op de naam: $jobListings

            return view('jobs_listing.index', ['jobListings' => $jobListings]);
        }

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

        return view('components.manager.dashboard', compact('jobListings'));
    }
}
