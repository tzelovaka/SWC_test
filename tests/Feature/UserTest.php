<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_many_bookings()
    {
        $user = User::factory()->create();
        Booking::factory()->count(3)->create(['user_id' => $user->id]);
        $this->assertEquals(3, $user->bookings()->count());
        foreach ($user->bookings as $booking) {
            $this->assertEquals($user->id, $booking->user_id);
        }
    }
}
