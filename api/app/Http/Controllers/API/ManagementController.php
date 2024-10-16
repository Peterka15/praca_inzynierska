<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagementResource;
use App\Models\Management;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(): JsonResponse
    {
        $management = Management::orderBy(Management::ID)->get();

        return $this->successResponse(ManagementResource::collection($management));
    }

    public function show(int $id): JsonResponse
    {
        $management = Management::find($id);

        if ($management === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new ManagementResource($management));
    }


    public function store(Request $request): JsonResponse
    {
        $request->validate(
            [
                Management::NAME => 'required|string',
                Management::FUNCTION => 'required|string',
                Management::UNIT_ID => 'required|int|exists:units,id',
            ]
        );

        $requestData = $request->all();
        $management = Management::create($requestData);

        return $this->successResponse(new ManagementResource($management));
    }


    public function update(Request $request, Management $management): JsonResponse
    {
        $request->validate(
            [
                Management::NAME => 'string',
                Management::FUNCTION => 'string',
                Management::UNIT_ID => 'int|exists:units,id',
            ]
        );

        $requestData = $request->all();
        $management->update($requestData);

        return $this->successResponse(new ManagementResource($management));
    }

    public function destroy(Management $management): JsonResponse
    {
        $management->delete();

        return $this->successResponse();
    }
}
