<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *      path="/api/resources",
 *      summary="Get all resources",
 *      description="Endpoint to retrieve a list of all resources.",
 *      tags={"Resources"},
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
 *                      @OA\Property(property="id", type="integer", example=1, description="The ID of the resource."),
 *                      @OA\Property(property="name", type="string", example="Conference Room A", description="The name of the resource."),
 *                      @OA\Property(property="description", type="string", example="A meeting room with a capacity of 10 people.", description="The description of the resource."),
 *                      @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the resource was created."),
 *                      @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the resource was last updated.")
 *                  )
 *              )
 *          )
 *      )
 *  ),
 *
 * @OA\Post(
 *      path="/api/resources",
 *      summary="Create a new resource",
 *      description="Endpoint to create a new resource with required fields 'name' and 'type', and an optional 'description'.",
 *      tags={"Resources"},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string", example="Conference Room B", description="The name of the resource. Required.", maxLength=255),
 *              @OA\Property(property="type", type="string", example="Meeting Room", description="The type of the resource. Required.", maxLength=255),
 *              @OA\Property(property="description", type="string", example="A meeting room with a capacity of 15 people.", description="The description of the resource. Optional.", maxLength=255)
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Resource created successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Ресурс успешно создан."),
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1, description="The ID of the created resource."),
 *                  @OA\Property(property="name", type="string", example="Conference Room B", description="The name of the resource."),
 *                  @OA\Property(property="type", type="string", example="Meeting Room", description="The type of the resource."),
 *                  @OA\Property(property="description", type="string", example="A meeting room with a capacity of 15 people.", description="The description of the resource."),
 *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the resource was created."),
 *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-01 12:00:00", description="Timestamp when the resource was last updated.")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="The given data was invalid."),
 *              @OA\Property(property="errors", type="object",
 *                  @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required.")),
 *                  @OA\Property(property="type", type="array", @OA\Items(type="string", example="The type field is required.")),
 *                  @OA\Property(property="description", type="array", @OA\Items(type="string", example="The description may not be greater than 255 characters."))
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal server error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Произошла ошибка при создании ресурса."),
 *              @OA\Property(property="error", type="string", example="Detailed error message from exception")
 *          )
 *      )
 *  )
 */
class ResourceController extends Controller
{
    //
}
