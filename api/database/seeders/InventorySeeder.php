<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inventory;
use Date;
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
                Inventory::AMOUNT => '2',
                Inventory::CATEGORY => 'Armatura Wodno-Pianowa',
                Inventory::UNIT => 'OSP ZAWADA',
                Inventory::ONSTATE => 'true'
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                Inventory::ID => 2,
                Inventory::NAME => 'Kominiarka',
                Inventory::AMOUNT => '30',
                Inventory::CATEGORY => 'Osobiste',
                Inventory::UNIT => 'OSP Pszów',
                Inventory::ONSTATE => 'true'
            ]
        );
    }
}
