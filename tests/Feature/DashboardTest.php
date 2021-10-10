<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_profile_selection()
    {
        $this->withSession([]);

        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('profiles.select'));
    }

    public function test_dashboard_shows_profile_info()
    {
        $profile = Profile::factory()->create([
            'name' => 'Nathan',
        ]);

        $this->withSession([
            'profile' => $profile->id,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertSee('Nathan');
    }
}
