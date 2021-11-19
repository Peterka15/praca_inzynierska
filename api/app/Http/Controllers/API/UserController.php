<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $data = User::latest()->get();
        return response()->json([UserResource::collection($data), 'Users fetched.']);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create(['name' => $request->name]);

        return response()->json(['User created successfully.', new UserResource($user)]);
    }

    public function show(int $id): JsonResponse
    {
        $program = User::find($id);

        if (is_null($program)) {
            return response()->json('Data not found', 404);
        }

        return response()->json([new UserResource($program)]);
    }


    public function update(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'string|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user->name = $request->name;
        if (isset ($request->email)) {

            $user->email = $request->email;
        }
        $user->save();

        return response()->json(['User updated successfully.', new UserResource($user)]);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json('User deleted successfully');
    }
}
