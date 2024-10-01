<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validationRules = [
            User::NAME => 'required|string|max:255',
            User::EMAIL => 'required|string|email|max:255|unique:users',
            User::PASSWORD => 'required|string|min:8',
            User::ROLE_ID => 'required|integer|min:1|exists:roles,id',
            User::UNIT_ID => 'required|integer|min:1|exists:units,id'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();
//var_dump($requestData);
        $requestData[User::PASSWORD] = Hash::make($requestData[User::PASSWORD]);
        $requestData[User::PASSWORD_CHANGE_IS_REQUIRED] = true;

        $user = User::create($requestData);

        return $this->successResponse($this->getResponseData($user, null));




    }

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

        if ($user->role_id == 6) {
            return $this->errorResponse(['role_id' => ['Logowanie nieudane. Rola o wartości 6 jest niedostępna.']], Response::HTTP_UNAUTHORIZED);
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
