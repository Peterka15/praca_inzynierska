<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCreatedResource;
use App\Http\Resources\UserResource;
use App\Models\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

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
        // Only admin is allowed to create new users
        if (!$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $validator = Validator::make($request->all(), [
            User::NAME => 'required|string|max:255|required',
            User::EMAIL => 'required|string|email|max:255|unique:users|required',
            User::ROLE_ID => 'required|integer|min:1|exists:roles,id|required',
            User::UNIT_ID => 'required|integer|min:1|exists:units,id|required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $requestData = $request->all();

        $user = User::create($requestData);
        $user->password = Hash::make(Uuid::uuid4()->toString());
        $user->password_change_token = Uuid::uuid4()->toString();
        $user->password_change_is_required = true;
        $user->save();

        return $this->successResponse(new UserCreatedResource($user));
    }

    public function resetPassword($id): JsonResponse
    {
        // Only admin is allowed to reset passwords
        if (!$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $user = User::findOrFail($id);

        if (!$user) {
            return $this->errorResponse(['email' => ['User not found.']], Response::HTTP_NOT_FOUND);
        }

        if ($user->role_enum->equals(UserRole::DISABLED())) {
            return $this->errorResponse(['password' => ['Account is disabled.']], Response::HTTP_UNAUTHORIZED);
        }

        $user->password_change_token = Uuid::uuid4()->toString();
        $user->password_change_is_required = true;
        $user->save();

        return $this->successResponse(new UserCreatedResource($user));
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
            User::EMAIL => 'string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

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

    public function destroy(User $user): JsonResponse
    {
        if (!$this->currentUser->isRole(UserRole::ADMIN())) {
            return $this->notAuthorisedResponse();
        }

        $user->role_id = UserRole::DISABLED()->getValue();
        $user->save();

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}
