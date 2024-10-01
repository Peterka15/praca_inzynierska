<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var User $user */
        $user = $this;

        return [
            User::ID => $user->id,
            User::NAME => $user->name,
            User::EMAIL => $user->email,
            User::CREATED_AT => $user->created_at,
            User::UPDATED_AT => $user->updated_at,
            User::UNIT => new UnitResource($user->unit),
            User::ROLE => new RoleResource($user->role),
            User::PASSWORD_CHANGE_IS_REQUIRED => $user->required_password_change,
        ];
    }
}
