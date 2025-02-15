<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_resources()
    {
        Resource::factory()->count(3)->create();
        $response = $this->getJson('/api/resources');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'type', 'description']
                ]
            ]);
    }

    public function test_post_creates_resource()
    {
        $data = [
            'name' => 'Test Resource',
            'type' => 'Test Type',
            'description' => 'Test Description',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Ресурс успешно создан.',
                'data' => [
                    'name' => 'Test Resource',
                    'type' => 'Test Type',
                    'description' => 'Test Description',
                ]
            ]);
        $this->assertDatabaseHas('resources', $data);
    }

    public function test_post_fails_with_invalid_data()
    {
        $data = [
            'type' => 'Test Type',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_post_handles_server_error()
    {
        $this->mock(ResourceRepository::class, function ($mock) {
            $mock->shouldReceive('create')
                ->andThrow(new \Exception('Server error'));
        });
        $data = [
            'name' => 'Test Resource',
            'type' => 'Test Type',
        ];
        $response = $this->postJson('/api/resources', $data);
        $response->assertStatus(500)
            ->assertJson([
                'message' => 'Произошла ошибка при создании ресурса.',
                'error' => 'Server error',
            ]);
    }

    public function test_resource_has_many_bookings()
    {
        $resource = Resource::factory()->create();
        Booking::factory()->count(3)->create(['resource_id' => $resource->id]);
        $this->assertEquals(3, $resource->bookings()->count());
        foreach ($resource->bookings as $booking) {
            $this->assertEquals($resource->id, $booking->resource_id);
        }
    }
}
