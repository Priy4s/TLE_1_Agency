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
        // Get the authenticated user
        $user = Auth::user();

        // If the user is an admin, only show job listings for their company
        if ($user->role === 'admin') {

            // Only get job listings that match the user's company_id
            $jobListings = JobListing::where('company_id', $user->company_id)->get();

            return view('components.manager.dashboard', ['jobListings' => $jobListings]);
        }

        // If the user is not an admin, handle the query search logic
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
            return $waitlist->status === 'selected';
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
