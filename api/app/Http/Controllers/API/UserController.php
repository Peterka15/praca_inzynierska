<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::latest()->get();

        return $this->successResponse(UserResource::collection($users));
    }

    public function getCurrent(): JsonResponse
    {
        return $this->successResponse(new UserResource($this->currentUser));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            User::NAME => 'string|max:255|required',
            User::EMAIL => 'string|email|max:255|unique:users|required',
            User::PASSWORD => 'string|min:8|required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $requestData = $request->all();

        if (isset($requestData[User::PASSWORD])) {
            $requestData[User::PASSWORD] = Hash::make($requestData[User::PASSWORD]);
        }

        $user = User::create($requestData);
        $user->save();

        return $this->successResponse(new UserResource($user));
    }

    public function show(int $id): JsonResponse
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new UserResource($user));
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            User::NAME => 'string|max:255',
            User::EMAIL => 'string|email|max:255|unique:users',
            User::PASSWORD => 'string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $requestData = $request->all();

        if (isset($requestData[User::PASSWORD])) {
            $requestData[User::PASSWORD] = Hash::make($requestData[User::PASSWORD]);
        }

        $user->fill($requestData);
        $user->save();

        return $this->successResponse(new UserResource($user));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return $this->successResponse();
    }
}
