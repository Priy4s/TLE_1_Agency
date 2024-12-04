
    <div class="job-header">
        <img src="{{ asset('images/pizza_delivery.webp') }}" alt="{{ $job->title }}">
        <h1>{{ $job->title }}</h1>
        <h2 class="job-type">{{ $job->position }}</h2>
        <p><strong>Location:</strong> Rotterdam</p>
    </div>

    <div class="job-details">
        <h3>Job Details</h3>
        <p><strong>Salary:</strong> € {{ $job->salary }}</p>
        <p><strong>Job:</strong> {{ $job->position }}</p>
        <p><strong>Type:</strong> {{ $job->type }}</p>
        <p><strong>Length:</strong> {{ $job->length }}</p>
        <p><strong>Hours:</strong> {{ $job->hours }}</p>
        <p><strong>Avg. Salary:</strong> {{ $job->avg_salary }}</p>
    </div>

    <div class="job-info">
        <h3>Job Information</h3>
        <p>{{ $job->description }}</p>
    </div>

    <button class="cta-button">Join the waiting list</button>


