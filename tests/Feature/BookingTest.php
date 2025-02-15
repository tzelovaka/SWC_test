<?php

namespace Tests\Feature;

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use App\Repositories\BookingRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_booking_successfully()
    {
        $user = User::factory()->create();
        $resource = Resource::factory()->create();
        $this->actingAs($user);
        $data = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDays(2)->toDateTimeString(),
        ];
        $response = $this->postJson('/api/bookings', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'user_id', 'resource_id', 'start_time', 'end_time'
            ]);
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'resource_id' => $resource->id,
        ]);
    }

    public function test_create_booking_server_error()
    {
        $user = User::factory()->create();
        $resource = Resource::factory()->create();
        $this->mock(BookingRepository::class, function ($mock) {
            $mock->shouldReceive('create')
                ->andThrow(new \Exception('Server error'));
        });
        $data = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDays(2)->toDateTimeString(),
        ];
        $response = $this->postJson('/api/bookings', $data);
        $response->assertStatus(500)
            ->assertJson([
                'message' => 'Произошла ошибка при создании бронирования.',
                'error' => 'Server error',
            ]);
    }

    public function test_validation_on_create_booking()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/bookings', []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['resource_id', 'start_time', 'end_time']);
    }

    public function test_get_bookings_list()
    {
        $booking = Booking::factory()->create();
        $resourceId = $booking->resource_id;
        $response = $this->getJson('/api/resources/'.$resourceId.'/bookings');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'user_id', 'resource_id', 'start_time', 'end_time']
                ]
            ]);
    }

    public function test_delete_booking_with_exceptions()
    {
        $booking = Booking::factory()->create();
        $response = $this->deleteJson("/api/bookings/{$booking->id}");
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Бронирование успешно удалено.',
            ]);
        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);
        $response = $this->deleteJson("/api/bookings/99999");
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Бронирование не найдено.',
            ]);
        $bookingRepository = $this->createMock(BookingRepository::class);
        $bookingRepository->method('find')->willReturn(new Booking());
        $bookingRepository->method('delete')->willThrowException(new \Exception('Test Exception'));
        $controller = new BookingController($bookingRepository);
        $response = $controller->delete($booking->id);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('Произошла ошибка при удалении бронирования.', $response->getData()->message);
        $this->assertEquals('Test Exception', $response->getData()->error);
    }

    public function test_booking_belongs_to_resource()
    {
        $resource = Resource::factory()->create();
        $booking = Booking::factory()->create([
            'resource_id' => $resource->id,
        ]);
        $this->assertEquals($resource->id, $booking->resource->id);
        $this->assertEquals($resource->name, $booking->resource->name);
        $this->assertEquals($resource->type, $booking->resource->type);
        $this->assertEquals($resource->description, $booking->resource->description);
    }

    public function test_booking_belongs_to_user()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->assertEquals($user->id, $booking->user->id);
        $this->assertEquals($user->name, $booking->user->name);
        $this->assertEquals($user->email, $booking->user->email);
    }
}
