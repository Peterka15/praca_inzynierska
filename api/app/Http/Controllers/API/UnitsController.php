<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;

class UnitsController extends Controller
{
    public function index(): JsonResponse
    {
        $unit = Unit::orderBy(Unit::NAME)->get();

        return $this->successResponse(UnitResource::collection($unit));
    }

    public function show(int $id): JsonResponse
    {
        $unit = Unit::find($id);

        if ($unit === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new UnitResource($unit));
    }
}
