<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookingRepository
{
    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function find(int $id): ?Model
    {
        return Booking::find($id);
    }

    public function delete(Model $booking): bool
    {
        return $booking->delete();
    }

    public function getByResourceId(int $resourceId): Collection
    {
        return Booking::where('resource_id', $resourceId)->get();
    }
}
