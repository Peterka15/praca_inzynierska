<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\In;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Inventory::TABLE_NAME)->insert(
            [
                Inventory::ID => 1,
                Inventory::NAME => 'Wąż W-52',
                Inventory::AMOUNT => 2,
                Inventory::CATEGORY_ID => 1,
                Inventory::UNIT_ID => 1,
                Inventory::AVAILABLE => true
            ]
        );

        DB::table(Inventory::TABLE_NAME)->insert(
            [
                Inventory::ID => 2,
                Inventory::NAME => 'Kominiarka',
                Inventory::AMOUNT => 30,
                Inventory::CATEGORY_ID => 5,
                Inventory::UNIT_ID => 2,
                Inventory::AVAILABLE => true
            ]
        );
    }
}
