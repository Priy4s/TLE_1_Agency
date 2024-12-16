@extends ('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Company</title>
</head>

<body class="bg-[#FBFCF6] text-[#2E342A] p-4">

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">Create Job Listing</h1>
        <form action="{{ route('company.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="block font-medium mb-2">Name:</label>
                <input type="text" name="name" id="name" required
                    class="w-full p-3 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="description" class="block font-medium mb-2">Description:</label>
                <input type="text" name="description" id="description" required
                    class="w-full p-3 border border-gray-300 rounded-md">
            </div>
            <div>
                <label for="location_id" class="block font-medium mb-2">Location:</label>
                <select name="location_id" id="location_id" class="w-full p-3 border border-gray-300 rounded-md">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="image">Upload Image:</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <div>
                <label for="video" class="block font-medium mb-2">Upload video:</label>
                <input type="file" name="video" id="video" accept="video/*">
            </div>
            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-[#E2ECC8] text-[#2E342A] font-semibold rounded-lg hover:bg-[#D1E0A9] focus:outline-none focus:ring-2 focus:ring-[#E2ECC8]">
                    Create Company
                </button>
                <a href="{{ route('company.index') }}"
                    class="ml-4 px-6 py-3 bg-gray-300 text-[#2E342A] font-semibold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Back to Profile
                </a>
            </div>
        </form>
    </div>
</body>

</html>
