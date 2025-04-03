<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(): JsonResponse
    {
        $inventories = Inventory::all();

        return $this->successResponse(InventoryResource::collection($inventories));
    }

    public function store(Request $request): JsonResponse
    {
        $validationRules = [
            Inventory::NAME => 'required|string',
            Inventory::AMOUNT => 'required|integer',
            Inventory::CATEGORY_ID => 'required|integer|min:1|exists:inventory_categories,id',
            Inventory::UNIT_ID => 'required|integer|min:1|exists:units,id',
            Inventory::AVAILABLE => 'required|boolean'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();
        $inventory = Inventory::create($requestData);

        return $this->successResponse(new InventoryResource($inventory));
    }

    public function show(int $id): JsonResponse
    {
        $article = Inventory::find($id);

        if ($article === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new InventoryResource($article));
    }

    public function update(Request $request, Inventory $inventory): JsonResponse
    {
        $validationRules = [
            Inventory::NAME => 'string',
            Inventory::AMOUNT => 'integer',
            Inventory::CATEGORY_ID => 'integer|min:1|exists:inventory_categories,id',
            Inventory::UNIT_ID => 'integer|min:1|exists:units,id',
            Inventory::AVAILABLE => 'boolean'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();

        $inventory->fill($requestData);
        $inventory->save();

        return $this->successResponse(new InventoryResource($inventory));
    }

    public function destroy(Inventory $inventory): JsonResponse
    {
        $inventory->delete();

        return $this->successResponse();
    }
}
