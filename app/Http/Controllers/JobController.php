<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Waitlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Show the job details page
    public function show($id)
    {
        $joblistings = JobListing::all();
        $job = $joblistings->firstWhere('id', $id);

        // Get the count of users on the waitlist with the status 'waiting' for this job
        $waitlistCount = Waitlist::where('job_id', $id)
            ->where('status', 'waiting')
            ->count();

        // Check if the current user is already on the waitlist for this job
        $userId = Auth::id();
        $isOnWaitlist = Waitlist::where('job_id', $id)
            ->where('user_id', $userId)
            ->exists();

        // Pass the waitlist count and user's waitlist status to the view
        return view('detail.job', compact('job', 'waitlistCount', 'isOnWaitlist'));
    }

    public function manageDetails($id)
    {
        $job = JobListing::find($id);
        return view('components.manager.managedetails', compact('job'));
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
            'status' => 'waiting', // Default status when a user joins
        ]);

        return redirect()->back()->with('success', 'You have successfully joined the waitlist for this job.');
    }

    public function hirePage($id)
    {
        $job = JobListing::findOrFail($id);

        // Get only users on the waitlist for this job, including their user details
        $waitlistUsers = Waitlist::where('job_id', $id)
            ->with('user')
            ->get();

        return view('components.manager.hire-people', compact('job', 'waitlistUsers'));
    }

    public function confirmHire(Request $request, $id)
    {
        $job = JobListing::findOrFail($id);

        // Get the number of candidates to hire
        $numCandidates = $request->input('num_candidates');

        // Get the first $numCandidates candidates with the status "waiting"
        $candidatesToHire = Waitlist::where('job_id', $id)
            ->where('status', 'waiting')
            ->take($numCandidates)
            ->get();

        // Check if there are enough candidates to hire
        if ($candidatesToHire->count() < $numCandidates) {
            return redirect()->back()->with('error', 'Not enough candidates available to hire.');
        }

        // Update the status of the selected candidates to 'hired'
        foreach ($candidatesToHire as $candidate) {
            if ($candidate->status !== 'hired') {
                $candidate->update(['status' => 'hired']);
            }
        }

        return redirect()->route('job.hire', $job->id)->with('success', "$numCandidates candidate(s) successfully hired.");
    }

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

    public function updateProcess(Request $request, $id)
    {
        $waitlist = Waitlist::findOrFail($id);

        // Validate the input
        $request->validate([
            'process' => 'required|in:Need to invite,Waiting for response,Done',
        ]);

        // Update the process status
        $waitlist->process = $request->input('process');
        $waitlist->save();

        return redirect()->back()->with('success', 'Process status updated successfully.');
    }
}
