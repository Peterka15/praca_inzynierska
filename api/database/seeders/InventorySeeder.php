<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Date;

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
                Inventory::AVAILABLE => true,
                Inventory::CREATED_AT => Date::now(),
                Inventory::UPDATED_AT => Date::now(),
            ]
        );

        DB::table(Inventory::TABLE_NAME)->insert(
            [
                Inventory::ID => 2,
                Inventory::NAME => 'Kominiarka',
                Inventory::AMOUNT => 30,
                Inventory::CATEGORY_ID => 5,
                Inventory::UNIT_ID => 2,
                Inventory::AVAILABLE => true,
                Inventory::CREATED_AT => Date::now(),
                Inventory::UPDATED_AT => Date::now(),
            ]
        );

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 3,
            Inventory::NAME => 'Wąż W-75',
            Inventory::AMOUNT => 5,
            Inventory::CATEGORY_ID => 1,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 4,
            Inventory::NAME => 'Prądownica typu Turbo',
            Inventory::AMOUNT => 3,
            Inventory::CATEGORY_ID => 1,
            Inventory::UNIT_ID => 2,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 5,
            Inventory::NAME => 'Motopompa Tohatsu',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 3,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 6,
            Inventory::NAME => 'Buty specjalne',
            Inventory::AMOUNT => 20,
            Inventory::CATEGORY_ID => 5,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 7,
            Inventory::NAME => 'Hełm strażacki',
            Inventory::AMOUNT => 15,
            Inventory::CATEGORY_ID => 5,
            Inventory::UNIT_ID => 4,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 8,
            Inventory::NAME => 'Pojazd GBA 3/16',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 4,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 9,
            Inventory::NAME => 'Siekiera ratownicza',
            Inventory::AMOUNT => 4,
            Inventory::CATEGORY_ID => 3,
            Inventory::UNIT_ID => 2,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 10,
            Inventory::NAME => 'Agregat prądotwórczy',
            Inventory::AMOUNT => 2,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 5,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 11,
            Inventory::NAME => 'Nożyce hydrauliczne',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 3,
            Inventory::UNIT_ID => 3,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 12,
            Inventory::NAME => 'Drabina nasadkowa',
            Inventory::AMOUNT => 2,
            Inventory::CATEGORY_ID => 2,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 13,
            Inventory::NAME => 'Gaśnica proszkowa 6kg',
            Inventory::AMOUNT => 10,
            Inventory::CATEGORY_ID => 2,
            Inventory::UNIT_ID => 4,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 14,
            Inventory::NAME => 'Zestaw PSP R1',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 5,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 15,
            Inventory::NAME => 'Latarka ręczna LED',
            Inventory::AMOUNT => 8,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 3,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 16,
            Inventory::NAME => 'Maska ODO',
            Inventory::AMOUNT => 5,
            Inventory::CATEGORY_ID => 5,
            Inventory::UNIT_ID => 2,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 17,
            Inventory::NAME => 'Rozpieracz kolumnowy',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 3,
            Inventory::UNIT_ID => 4,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 18,
            Inventory::NAME => 'Piła do betonu',
            Inventory::AMOUNT => 1,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 5,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 19,
            Inventory::NAME => 'Ubranie specjalne Nomex',
            Inventory::AMOUNT => 12,
            Inventory::CATEGORY_ID => 5,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 20,
            Inventory::NAME => 'Radiostacja nasobna',
            Inventory::AMOUNT => 6,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 2,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 21,
            Inventory::NAME => 'Kamizelka odblaskowa',
            Inventory::AMOUNT => 25,
            Inventory::CATEGORY_ID => 5,
            Inventory::UNIT_ID => 1,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);

        DB::table(Inventory::TABLE_NAME)->insert([
            Inventory::ID => 22,
            Inventory::NAME => 'Torba medyczna',
            Inventory::AMOUNT => 2,
            Inventory::CATEGORY_ID => 6,
            Inventory::UNIT_ID => 4,
            Inventory::AVAILABLE => true,
            Inventory::CREATED_AT => Date::now(),
            Inventory::UPDATED_AT => Date::now(),
        ]);
    }
}
