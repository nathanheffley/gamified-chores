<?php

namespace Tests\Feature;

use App\Models\Chore;
use App\Models\ChoreTask;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_shows_completed_unapproved_tasks()
    {
        $profileOne = Profile::factory()->create([
            'name' => 'Nathan',
        ]);
        $profileTwo = Profile::factory()->create([
            'name' => 'Nate',
        ]);

        $choreTaskOne = ChoreTask::factory()->create([
            'profile_id' => $profileOne,
            'completed_at' => now()->subHour(),
            'approved_at' => null,
        ]);
        $choreTaskTwo = ChoreTask::factory()->create([
            'profile_id' => $profileTwo,
            'completed_at' => now()->subMinute(),
            'approved_at' => null,
        ]);

        // Incomplete task
        ChoreTask::factory()->create([
            'completed_at' => null,
        ]);

        // Approved task
        ChoreTask::factory()->create([
            'completed_at' => now(),
            'approved_at' => now(),
        ]);

        $response = $this->get(route('review.show'));

        $response->assertViewHas('tasks', collect([
            [
                'id' => $choreTaskOne->id,
                'photo' => $choreTaskOne->chore->photo,
                'title' => $choreTaskOne->chore->title,
                'points' => $choreTaskOne->chore->points,
                'name' => $profileOne->name,
                'completed_at' => '1 hour ago',
            ],
            [
                'id' => $choreTaskTwo->id,
                'photo' => $choreTaskTwo->chore->photo,
                'title' => $choreTaskTwo->chore->title,
                'points' => $choreTaskTwo->chore->points,
                'name' => $profileTwo->name,
                'completed_at' => '1 minute ago',
            ],
        ]));
    }

    public function test_chore_task_can_be_approved()
    {
        $choreTask = ChoreTask::factory()->create([
            'completed_at' => now(),
            'approved_at' => null,
        ]);

        $response = $this->post(route('review.approve', $choreTask));

        $choreTask->refresh();
        $this->assertNotNull($choreTask->completed_at);
        $this->assertNotNull($choreTask->approved_at);

        $response->assertRedirect(route('review.show'));
    }

    public function test_chore_task_can_be_rejected()
    {
        $profile = Profile::factory()->create([
            'points' => 14,
        ]);

        $chore = Chore::factory()->create([
            'points' => 3,
        ]);

        $choreTask = ChoreTask::factory()->create([
            'chore_id' => $chore->id,
            'profile_id' => $profile->id,
            'completed_at' => now(),
            'approved_at' => null,
        ]);

        $response = $this->post(route('review.reject', $choreTask));

        $this->assertSame(11, $profile->fresh()->points);

        $choreTask->refresh();
        $this->assertNull($choreTask->completed_at);
        $this->assertNull($choreTask->approved_at);

        $response->assertRedirect(route('review.show'));
    }
}
