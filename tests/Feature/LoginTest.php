<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_options_are_listed()
    {
        Profile::factory()->create([
            'name' => 'Nathan',
        ]);
        Profile::factory()->create([
            'name' => 'Nate',
        ]);

        $response = $this->get(route('profiles.select'));

        $response->assertSee('Nathan');
        $response->assertSee('Nate');
    }

    public function test_profile_can_be_logged_in_to()
    {
        $profile = Profile::factory()->create();

        $response = $this->get(route('profiles.login', $profile));

        $response->assertRedirect(route('dashboard'));

        $response->assertSessionHas('profile', $profile->id);
    }
}
