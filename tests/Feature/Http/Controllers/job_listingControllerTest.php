<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\job_listingController
 */
final class job_listingControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_displays_view(): void
    {
        $jobListings = job_listing::factory()->count(3)->create();

        $response = $this->get(route('job_listings.index'));

        $response->assertOk();
        $response->assertViewIs('jobs_listing.index');
        $response->assertViewHas(' jobs');
    }
}
