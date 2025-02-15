<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Repositories\BookingRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function post(BookingRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $booking = $this->bookingRepository->create($data);
            return response()->json($booking, 201);
        } catch (Exception $e) {
            Log::error("Ошибка при создании бронирования: " . $e->getMessage());
            return response()->json([
                'message' => 'Произошла ошибка при создании бронирования.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $booking = $this->bookingRepository->find($id);
            if (!$booking) {
                return response()->json([
                    'message' => 'Бронирование не найдено.',
                ], 404);
            }
            $this->bookingRepository->delete($booking);
            return response()->json([
                'message' => 'Бронирование успешно удалено.',
            ], 200);
        } catch (Exception $e) {
            Log::error("Ошибка при удалении бронирования: " . $e->getMessage());
            return response()->json([
                'message' => 'Произошла ошибка при удалении бронирования.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
