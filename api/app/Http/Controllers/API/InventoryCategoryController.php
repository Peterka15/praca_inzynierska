<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryCategoryResource;
use App\Models\InventoryCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = InventoryCategory::all();

        return $this->successResponse(InventoryCategoryResource::collection($categories));
    }

    public function store(Request $request): JsonResponse
    {
        $validationRules = [
            InventoryCategory::NAME => 'required|string',
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();
        $inventory = InventoryCategory::create($requestData);

        return $this->successResponse(new InventoryCategoryResource($inventory));
    }

    public function show(int $id): JsonResponse
    {
        $article = InventoryCategory::find($id);

        if ($article === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new InventoryCategoryResource($article));
    }

    public function update(Request $request, InventoryCategory $inventory): JsonResponse
    {
        $validationRules = [
            InventoryCategory::NAME => 'string',
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();

        $inventory->fill($requestData);
        $inventory->save();

        return $this->successResponse(new InventoryCategoryResource($inventory));
    }

    public function destroy(InventoryCategory $article): JsonResponse
    {
        $article->delete();

        return $this->successResponse();
    }
}
