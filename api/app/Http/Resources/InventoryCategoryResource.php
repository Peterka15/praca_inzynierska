<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryCategoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var InventoryCategory $inventoryCategory */
        $inventoryCategory = $this;

        return [
            InventoryCategory::ID => $inventoryCategory->id,
            InventoryCategory::NAME => $inventoryCategory->name,
        ];
    }
}
