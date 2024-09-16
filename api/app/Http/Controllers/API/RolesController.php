<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{
    public function index(): JsonResponse
    {
        $unit = Role::orderBy(Role::NAME)->get();

        return $this->successResponse(RoleResource::collection($unit));
    }

    public function show(int $id): JsonResponse
    {
        $role = Role::find($id);

        if ($role === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new RoleResource($role));
    }
}
