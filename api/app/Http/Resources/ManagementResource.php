<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Management;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagementResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Management $management */
        $management = $this;

        return [
            Management::ID => $management->id,
            Management::NAME => $management->name,
            Management::FUNCTION => $management->function,
            Management::UNIT => new UnitResource($management->unit)
        ];
    }
}
