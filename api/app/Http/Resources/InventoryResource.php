<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Inventory $inventory */
        $inventory = $this;

        return [
            Inventory::ID => $inventory->id,
            Inventory::NAME => $inventory->name,
            Inventory::AMOUNT => $inventory->amount,
            Inventory::CATEGORY => new InventoryCategoryResource($inventory->category_id),
            Inventory::UNIT => new UnitResource($inventory->unit_id),
            Inventory::AVAILABLE => $inventory->available
        ];
    }
}
