<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Waitlist; // Import the Waitlist model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth to get the logged-in user

class JobController extends Controller
{
    // Show the job details page
    public function show($id)
    {
        $joblistings = JobListing::all();
        $job = $joblistings->firstWhere('id', $id);

        return view('detail.job', compact('job'));
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
}
