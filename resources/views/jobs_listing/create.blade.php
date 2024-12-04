<!DOCTYPE html>
<html>
<head>
    <title>Create Job Listing</title>
</head>
<body>
    <h1>Create Job Listing</h1>
    <form action="{{ route('joblistings.store') }}" method="POST">
        @csrf
        <div>
            <label for="position">Position:</label>
            <input type="text" name="position" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" required>
        </div>
        <div>
            <label for="length">Length:</label>
            <input type="number" name="length" required>
        </div>
        <div>
            <label for="hours">Hours:</label>
            <input type="number" name="hours" required>
        </div>
        <div>
            <label for="salary">Salary:</label>
            <input type="number" step="0.01" name="salary" required>
        </div>
        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" required>
        </div>
        <div>
            <label for="location_id">Location ID:</label>
            <input type="number" name="location_id" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="text" name="image" required>
        </div>
        <div>
            <label for="video">Video:</label>
            <input type="text" name="video" required>
        </div>
             <div>
            <label for="company_id">Company ID:</label>
            <input type="number" name="company_id" required>
        </div>
        <div>
            <label for="company">Company:</label>
            <input type="text" name="company" required>
        </div>
        <div>
            <label for="needed">Needed:</label>
            <input type="checkbox" name="needed" value="1">
        </div>
        <div>
            <label for="drivers_license">Driver's License Required:</label>
            <input type="checkbox" name="drivers_license" value="1">
        </div>
        <div>
            <button type="submit">Create Job</button>
        </div>
    </form>
</body>
</html>
