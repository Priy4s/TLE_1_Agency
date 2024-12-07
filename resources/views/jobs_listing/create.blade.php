@extends ('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Listing</title>
</head>
<body class="bg-[#FBFCF6] text-[#2E342A] p-4">

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">Create Job Listing</h1>
        <form action="{{ route('job_listings.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="position" class="block font-medium mb-2">Position:</label>
                <input type="text" name="position" id="position" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="description" class="block font-medium mb-2">Description:</label>
                <input type="text" name="description" id="description" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="length" class="block font-medium mb-2">Length (in months):</label>
                <input type="number" name="length" id="length" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="hours" class="block font-medium mb-2">Hours per week:</label>
                <input type="number" name="hours" id="hours" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="salary" class="block font-medium mb-2">Salary:</label>
                <input type="number" name="salary" id="salary" step="0.01" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="type" class="block font-medium mb-2">Type:</label>
                <input type="text" name="type" id="type" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="location_id" class="block font-medium mb-2">Location ID:</label>
                <input type="number" name="location_id" id="location_id" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="image" class="block font-medium mb-2">Image URL:</label>
                <input type="text" name="image" id="image"  class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="video" class="block font-medium mb-2">Video URL:</label>
                <input type="text" name="video" id="video"  class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <div>
                <label for="company_id" class="block font-medium mb-2">Company ID:</label>
                <input type="number" name="company_id" id="company_id" required class="w-full p-3 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="needed" class="block font-medium mb-2">Needed:</label>
                <select name="needed" id="needed" class="w-full p-3 border border-gray-300 rounded-md">
                    @for ($i = 0; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="drivers_license" class="block font-medium mb-2">Driver's License Required:</label>
                <select name="drivers_license" id="drivers_license" class="w-full p-3 border border-gray-300 rounded-md">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-6 py-3 bg-[#E2ECC8] text-[#2E342A] font-semibold rounded-lg hover:bg-[#D1E0A9] focus:outline-none focus:ring-2 focus:ring-[#E2ECC8]">
                    Create Job Vacancy
                </button>
                <a href="{{ route('job_listings.index') }}" class="ml-4 px-6 py-3 bg-gray-300 text-[#2E342A] font-semibold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Back to Job Listings
                </a>
            </div>
        </form>
    </div>
</body>
</html>
