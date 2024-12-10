<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import the Waitlist model
// Import Auth to get the logged-in user

class JobController extends Controller
{
    // Show the job details page
    public function show($id)
    {
        $joblistings = JobListing::all();
        $job = $joblistings->firstWhere('id', $id);

        // Get the count of users on the waitlist for this job
        $waitlistCount = Waitlist::where('job_id', $id)->count();

        // Pass the waitlist count to the view
        return view('detail.job', compact('job', 'waitlistCount'));
    }

    public function manageDetails($id)
    {
        $job = JobListing::find($id);
        return view('components.manager.managedetails', compact('job'));
    }


    // Handle joining the waitlist
    public function joinWaitlist(Request $request, $id)
    {
        // Get the authenticated user
        $userId = Auth::id();

        // Check if the user is already on the waitlist for this job
        $exists = Waitlist::where('job_id', $id)
            ->where('user_id', $userId)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already on the waitlist for this job.');
        }

        // Add the user to the waitlist for this job
        Waitlist::create([
            'job_id' => $id,
            'user_id' => $userId,
            'status' => 'in_process', // Default status when a user joins
        ]);

        return redirect()->back()->with('success', 'You have successfully joined the waitlist for this job.');
    }

    public function hirePage($id)
    {
        $job = JobListing::findOrFail($id);

        // Haal alleen de gebruikers die op de wachtlijst staan op, zonder hun persoonlijke gegevens
        $waitlistUsers = Waitlist::where('job_id', $id)->get();

        return view('components.manager.hire-people', compact('job', 'waitlistUsers'));
    }
}
