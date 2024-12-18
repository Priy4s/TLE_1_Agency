<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use App\Models\Location;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class CompanyController extends Controller
{
    public function __construct()
    {
        // Ensure the user is authenticated before accessing any methods in the controller
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $companies = Company::all();
            return view('company.index', compact('companies'));
        }
        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'location_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|video|mimes:mp4,mov,avi,wmv,flv|max:2048',
        ]);

        // Find the location by its ID
        $location = \App\Models\Location::find($validatedData['location_id']);
        $validatedData['location'] = $location;

        // If an image is uploaded, store it in the 'company_images' directory
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('company_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // If a video is uploaded, store it in the 'company_videos' directory
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('company_videos', 'public');
            $validatedData['video'] = $videoPath;
        }

        // Create the new company in the database
        $company = \App\Models\Company::create($validatedData);

        // Get the currently authenticated user
        $user = Auth::user();

        if ($user) {
            $user->company_id = $company->id;  // Set company_id to the new company's ID
            $user->save();  // Save the user with the new company_id
        } else {
            // Handle the case when there is no authenticated user
            return redirect()->route('login')->with('error', 'You must be logged in to create a company.');
        }


        // Redirect the user to the manager dashboard
        return redirect()->route('manager.dashboard');
    }


    public function create()
    {
        $locations = Location::all();
        $companies = Company::all();

        return view('company.create', compact('locations', 'companies'));
    }

    public function addMember(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        // Find the user by their email
        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            // Get the currently authenticated user
            $authUser = Auth::user();

            if ($authUser) {
                // Set the company_id of the found user to the company_id of the authenticated user
                $user->company_id = $authUser->company_id;
                $user->save();  // Save the user with the new company_id

                return redirect()->route('manager.dashboard')->with('success', 'Member added successfully.');
            } else {
                // Handle the case when there is no authenticated user
                return redirect()->route('login')->with('error', 'You must be logged in to add a member.');
            }
        } else {
            // Handle the case when the user with the provided email is not found
            return redirect()->back()->with('error', 'User with the provided email not found.');
        }
    }
}
