<?php

namespace Tests\Feature;

use App\Models\Counter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CounterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the home page displays the counter.
     */
    public function test_home_page_displays_counter(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('welcome')
                ->has('count')
        );
    }

    /**
     * Test that the counter starts at 0 when no counter exists.
     */
    public function test_counter_starts_at_zero(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->where('count', 0)
        );
    }

    /**
     * Test that the counter can be incremented.
     */
    public function test_counter_can_be_incremented(): void
    {
        // First request should create counter at 0
        $this->get('/');
        
        // Increment the counter
        $response = $this->post('/counter');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->where('count', 1)
        );

        // Verify counter was persisted in database
        $this->assertDatabaseHas('counters', [
            'count' => 1
        ]);
    }

    /**
     * Test that multiple increments work correctly.
     */
    public function test_multiple_increments(): void
    {
        // Create initial counter
        $this->get('/');
        
        // Increment 3 times
        $this->post('/counter');
        $this->post('/counter');
        $response = $this->post('/counter');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->where('count', 3)
        );

        // Verify final count in database
        $this->assertDatabaseHas('counters', [
            'count' => 3
        ]);
    }

    /**
     * Test that counter persists across requests.
     */
    public function test_counter_persists_across_requests(): void
    {
        // Create and increment counter
        $this->get('/');
        $this->post('/counter');
        $this->post('/counter');

        // New request should show persisted count
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->where('count', 2)
        );
    }

    /**
     * Test that existing counter is used if it exists.
     */
    public function test_uses_existing_counter(): void
    {
        // Create counter with specific count
        Counter::create(['count' => 42]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->where('count', 42)
        );
    }
}