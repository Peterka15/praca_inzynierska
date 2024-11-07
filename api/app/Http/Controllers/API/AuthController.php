<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Enums\UserRole;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validationRules = [
            User::EMAIL => 'required|string|email|max:255|exists:App\Models\User,email',
            User::PASSWORD => 'required|string|min:8',
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();

        if (!Auth::attempt(['email' => $requestData[User::EMAIL], 'password' => $requestData[User::PASSWORD]])) {
            return $this->errorResponse(['password' => ['Wrong password.']], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where(User::EMAIL, $request[User::EMAIL])->firstOrFail();

        if ($user->role_enum->equals(UserRole::DISABLED())) {
            return $this->errorResponse(['password' => ['Account is disabled.']], Response::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse($this->getResponseData($user, $token));
    }

    public function refresh(): JsonResponse
    {
        $this->currentUser->tokens()->delete();
        $token = $this->currentUser->createToken('auth_token')->plainTextToken;

        return $this->successResponse($this->getResponseData($this->currentUser, $token));
    }

    public function logout(): JsonResponse
    {
        $this->currentUser->tokens()->delete();

        return $this->successResponse();
    }

    public function setPassword(Request $request, string $uuid): JsonResponse
    {
        $validationRules = [
            User::PASSWORD => 'required|string|min:8',
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $user = User::wherePasswordChangeToken($uuid)->first();

        if (!$user) {
            return $this->errorResponse(['uuid' => ['Token not found.']], Response::HTTP_NOT_FOUND);
        }

        $requestData = $request->all();

        $user->password = Hash::make($requestData[User::PASSWORD]);
        $user->password_change_token = null;
        $user->password_change_is_required = false;

        $user->save();

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }

    private function getResponseData(User $user, ?string $token): array
    {
        if (!$token) {
            return ['user' => new UserResource($user)];
        }

        return [
            'user' => new UserResource($user),
            'access_token' => $token,
            'expires_in' => ((int)env('TOKEN_EXPIRE_DELAY_MINUTES')) * 60
        ];
    }
}
