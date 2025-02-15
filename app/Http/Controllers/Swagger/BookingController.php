<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/bookings",
 *     summary="Create a new booking",
 *     description="Endpoint to create a new booking for a resource by specifying the resource ID, user ID, start time, and end time.",
 *     tags={"Bookings"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="resource_id", type="integer", example=1, description="The ID of the resource."),
 *             @OA\Property(property="user_id", type="integer", example=1, description="The ID of the user."),
 *             @OA\Property(property="start_time", type="string", format="date-time", example="2023-10-01 12:00:00", description="Start time of the booking."),
 *             @OA\Property(property="end_time", type="string", format="date-time", example="2023-10-01 14:00:00", description="End time of the booking."),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Booking created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1, description="The ID of the created booking."),
 *             @OA\Property(property="resource_id", type="integer", example=1, description="The ID of the resource."),
 *             @OA\Property(property="user_id", type="integer", example=1, description="The ID of the user."),
 *             @OA\Property(property="start_time", type="string", format="date-time", example="2023-10-01 12:00:00", description="Start time of the booking."),
 *             @OA\Property(property="end_time", type="string", format="date-time", example="2023-10-01 14:00:00", description="End time of the booking."),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the booking was created."),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the booking was last updated.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="resource_id", type="array", @OA\Items(type="string", example="The resource id field is required.")),
 *                 @OA\Property(property="user_id", type="array", @OA\Items(type="string", example="The user id field is required.")),
 *                 @OA\Property(property="start_time", type="array", @OA\Items(type="string", example="The start time field is required.")),
 *                 @OA\Property(property="end_time", type="array", @OA\Items(type="string", example="The end time must be a date after start time."))
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Произошла ошибка при создании бронирования."),
 *             @OA\Property(property="error", type="string", example="An internal server error occurred.")
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *      path="/api/bookings/{id}",
 *      summary="Delete a booking by ID",
 *      description="Endpoint to delete an existing booking by its ID.",
 *      tags={"Bookings"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the booking to delete",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Booking deleted successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Бронирование успешно удалено.")
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Booking not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Бронирование не найдено.")
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal server error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Произошла ошибка при удалении бронирования."),
 *              @OA\Property(property="error", type="string", example="Detailed error message from exception")
 *          )
 *      )
 *  )
 */
class BookingController extends Controller
{
}
