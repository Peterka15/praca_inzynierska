<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Role $role */
        $role = $this;

        return [
            Role::ID => $role->id,
            Role::NAME => $role->name,
        ];
    }
}
