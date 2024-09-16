<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Unit $unit */
        $unit = $this;

        return [
            Unit::ID => $unit->id,
            Unit::NAME => $unit->name,
        ];
    }
}
