<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\InventoryCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(InventoryCategory::TABLE_NAME)->insert(
            [
                [InventoryCategory::ID => 1, InventoryCategory::NAME => 'armatura wodno-pianowa'],
                [InventoryCategory::ID => 2, InventoryCategory::NAME => 'sprzęt podręczny'],
                [InventoryCategory::ID => 3, InventoryCategory::NAME => 'sprzęt burzący'],
                [InventoryCategory::ID => 4, InventoryCategory::NAME => 'pojazd'],
                [InventoryCategory::ID => 5, InventoryCategory::NAME => 'sprzęt indywidualny'],
                [InventoryCategory::ID => 6, InventoryCategory::NAME => 'sprzęt techniczny']
            ]
        );
    }
}
