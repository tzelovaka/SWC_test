<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(int $id): JsonResponse
    {
        $bookings = $this->bookingService->getBookingsByResourceId($id);
        return response()->json(['data' => BookingResource::collection($bookings)->resolve()]);
    }
}
