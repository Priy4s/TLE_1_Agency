<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Show the job details page
    public function show($id)
    {
        $joblistings = JobListing::all();
        $job = $joblistings->firstWhere('id', $id);

        // Get the count of users on the waitlist for this job
        $waitlistCount = Waitlist::where('job_id', $id)->count();

        // Check if the current user is already on the waitlist for this job
        $userId = Auth::id();
        $isOnWaitlist = Waitlist::where('job_id', $id)
            ->where('user_id', $userId)
            ->exists();

        // Pass the waitlist count and user's waitlist status to the view
        return view('detail.job', compact('job', 'waitlistCount', 'isOnWaitlist'));
    }

    // Handle joining the waitlist
    public function joinWaitlist(Request $request, $id)
    {
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
            'status' => 'in_process',
        ]);

        return redirect()->back()->with('success', 'You have successfully joined the waitlist for this job.');
    }

    // Handle leaving the waitlist
    public function leaveWaitlist(Request $request, $id)
    {
        $userId = Auth::id();

        // Check if the user is on the waitlist
        $waitlistEntry = Waitlist::where('job_id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$waitlistEntry) {
            return redirect()->back()->with('error', 'You are not on the waitlist for this job.');
        }

        // Remove the user from the waitlist
        $waitlistEntry->delete();

        return redirect()->back()->with('success', 'You have successfully left the waitlist for this job.');
    }
}
