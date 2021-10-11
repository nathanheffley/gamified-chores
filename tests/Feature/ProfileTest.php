<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profiles_can_be_listed()
    {
        Profile::factory()->create([
            'name' => 'Nathan',
        ]);
        Profile::factory()->create([
            'name' => 'Nate',
        ]);

        $response = $this->get(route('profiles.index'));

        $response->assertSee('Nathan');
        $response->assertSee('Nate');
    }

    public function test_profile_can_be_created()
    {
        $response = $this->post(route('profiles.store'), [
            'name' => 'Jonathan',
            'photo' => 'Sad',
        ]);

        $this->assertDatabaseHas('profiles', [
            'name' => 'Jonathan',
            'photo' => 'Sad',
        ]);

        $response->assertRedirect(route('profiles.index'));
    }

    public function test_profile_cannot_be_created_without_a_name()
    {
        $this->withExceptionHandling();

        $response = $this->post(route('profiles.store'), [
            'photo' => 'Surprised',
        ]);

        $this->assertDatabaseCount('profiles', 0);

        $response->assertSessionHasErrors('name');
    }

    public function test_profile_cannot_be_created_with_non_string_name()
    {
        $this->withExceptionHandling();

        $response = $this->post(route('profiles.store'), [
            'name' => 42,
            'photo' => 'Happy',
        ]);

        $this->assertDatabaseCount('profiles', 0);

        $response->assertSessionHasErrors('name');
    }

    public function test_profile_cannot_be_created_without_a_photo()
    {
        $this->withExceptionHandling();

        $response = $this->post(route('profiles.store'), [
            'name' => 'Nathan',
        ]);

        $this->assertDatabaseCount('profiles', 0);

        $response->assertSessionHasErrors('photo');
    }

    public function test_profile_cannot_be_created_with_invalid_photo()
    {
        $this->withExceptionHandling();

        $response = $this->post(route('profiles.store'), [
            'name' => 'Jonathan',
            'photo' => 'Not A Photo',
        ]);

        $this->assertDatabaseCount('profiles', 0);

        $response->assertSessionHasErrors('photo');
    }

    public function test_profile_can_be_destroyed()
    {
        $profile = Profile::factory()->create();

        $response = $this->delete(route('profiles.destroy', $profile));

        $this->assertDatabaseCount('profiles', 0);

        $response->assertRedirect(route('profiles.index'));
    }
}
