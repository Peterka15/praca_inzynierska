<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Enums\UserRole;
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

        // Only admin is allowed to create new users
        if (!$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $requestData = $request->all();

        // Todo will it work with non-fillable field? Probably not.
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
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        var_dump($this->currentUser->role_enum);

        if ($user->id !== $this->currentUser->id && !$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $requestData = $request->all();

        if (isset($requestData[User::ROLE_ID]) && !$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        if (isset($requestData[User::UNIT_ID]) && !$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $user->fill($requestData);
        $user->save();

        return $this->successResponse(new UserResource($user));
    }
}
