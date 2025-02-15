<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *      path="/api/resources/{id}/bookings",
 *      summary="Get all bookings for a specific resource",
 *      description="Endpoint to retrieve all bookings associated with a specific resource ID.",
 *      tags={"Index"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the resource whose bookings are to be retrieved",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      type="object",
 *                      @OA\Property(property="id", type="integer", example=1, description="The ID of the booking."),
 *                      @OA\Property(property="resource_id", type="integer", example=1, description="The ID of the resource."),
 *                      @OA\Property(property="user_id", type="integer", example=1, description="The ID of the user."),
 *                      @OA\Property(property="start_time", type="string", format="date-time", example="2023-10-01 12:00:00", description="Start time of the booking."),
 *                      @OA\Property(property="end_time", type="string", format="date-time", example="2023-10-01 14:00:00", description="End time of the booking."),
 *                      @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the booking was created."),
 *                      @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the booking was last updated.")
 *                  )
 *              )
 *          )
 *      )
 *  )
 */
class IndexController extends Controller
{
    //
}
