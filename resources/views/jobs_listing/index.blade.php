@extends('layouts.app')

@section('content')
    <h1>Job Listings</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Position</th>
                <th>Description</th>
                <th>Length</th>
                <th>Hours</th>
                <th>Salary</th>
                <th>Location</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobListings as $jobListing)
                <tr>
                    <td>{{ $jobListing->position }}</td>
                    <td>{{ $jobListing->description }}</td>
                    <td>{{ $jobListing->length }}</td>
                    <td>{{ $jobListing->hours }}</td>
                    <td>{{ $jobListing->salary }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No job listings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
