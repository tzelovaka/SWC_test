<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        Log::info("Бронирование создано: {$booking->id}");
    }

    public function deleted(Booking $booking): void
    {
        Log::info("Бронирование отменено: {$booking->id}");
    }
}
