<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResourceController extends Controller
{
    protected ResourceRepository $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $resources = Resource::all();
        return ResourceResource::collection($resources);
    }

    public function post(ResourceRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $resource = $this->resourceRepository->create($data);
            return response()->json([
                'message' => 'Ресурс успешно создан.',
                'data' => $resource,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Произошла ошибка при создании ресурса.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
