<?php

namespace Tests\Feature;

use App\Models\Chore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_chores_can_be_listed()
    {
        Chore::factory()->create([
            'title' => 'A Test Chore',
            'points' => 7,
            'photo' => 'test-chore.png',
        ]);
        Chore::factory()->create([
            'title' => 'Some Test Chore',
            'points' => 3,
            'photo' => 'some-chore.png',
        ]);

        $response = $this->get(route('chores.index'));

        $response->assertSee('A Test Chore');
        $response->assertSee(7);
        $response->assertSee('test-chore.png');

        $response->assertSee('Some Test Chore');
        $response->assertSee(3);
        $response->assertSee('some-chore.png');
    }
}
