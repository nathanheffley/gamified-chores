<?php

namespace Tests\Feature;

use App\Models\Chore;
use App\Models\ChoreTask;
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

    public function test_dashboard_requires_existing_profile_selection()
    {
        $this->withSession([
            'profile' => '123',
        ]);

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

    public function test_dashboard_shows_unclaimed_tasks()
    {
        $profile = Profile::factory()->create([
            'name' => 'Nathan',
        ]);

        $this->withSession([
            'profile' => $profile->id,
        ]);

        $choreTaskOne = ChoreTask::factory()->create([
            'profile_id' => null,
            'completed_at' => null,
        ]);
        $choreTaskTwo = ChoreTask::factory()->create([
            'profile_id' => null,
            'completed_at' => null,
        ]);

        // Claimed task
        ChoreTask::factory()->create([
            'profile_id' => $profile->id,
            'completed_at' => null,
        ]);

        // Already completed task
        ChoreTask::factory()->create([
            'profile_id' => null,
            'completed_at' => now(),
        ]);

        $response = $this->get('dashboard');

        $response->assertViewHas('available_chores', collect([
            [
                'id' => $choreTaskOne->id,
                'photo' => $choreTaskOne->chore->photo,
                'title' => $choreTaskOne->chore->title,
                'points' => $choreTaskOne->chore->points,
            ],
            [
                'id' => $choreTaskTwo->id,
                'photo' => $choreTaskTwo->chore->photo,
                'title' => $choreTaskTwo->chore->title,
                'points' => $choreTaskTwo->chore->points,
            ],
        ]));
    }

    public function test_dashboard_shows_your_unfinished_claimed_tasks()
    {
        $profile = Profile::factory()->create([
            'name' => 'Nathan',
        ]);

        $this->withSession([
            'profile' => $profile->id,
        ]);

        $choreTaskOne = ChoreTask::factory()->create([
            'profile_id' => $profile->id,
            'completed_at' => null,
        ]);
        $choreTaskTwo = ChoreTask::factory()->create([
            'profile_id' => $profile->id,
            'completed_at' => null,
        ]);

        // Unclaimed task
        ChoreTask::factory()->create([
            'profile_id' => null,
        ]);

        // Task claimed by another profile
        ChoreTask::factory()->create([
            'profile_id' => Profile::factory()->create()->id,
        ]);

        // Already completed task
        ChoreTask::factory()->create([
            'profile_id' => $profile->id,
            'completed_at' => now(),
        ]);

        $response = $this->get('dashboard');

        $response->assertViewHas('your_chores', collect([
            [
                'id' => $choreTaskOne->id,
                'photo' => $choreTaskOne->chore->photo,
                'title' => $choreTaskOne->chore->title,
                'points' => $choreTaskOne->chore->points,
            ],
            [
                'id' => $choreTaskTwo->id,
                'photo' => $choreTaskTwo->chore->photo,
                'title' => $choreTaskTwo->chore->title,
                'points' => $choreTaskTwo->chore->points,
            ],
        ]));
    }
}
