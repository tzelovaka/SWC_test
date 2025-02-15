<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    protected BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function getBookingsByResourceId(int $resourceId): Collection
    {
        return $this->bookingRepository->getByResourceId($resourceId);
    }
}
