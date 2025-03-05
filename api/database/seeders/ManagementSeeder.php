<?php
declare(strict_types=1);

namespace Database\Seeders;


use App\Models\Management;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 1,
                Management::NAME => 'Jan Kowalski',
                Management::FUNCTION => 'Prezes',
                Management::UNIT_ID => 1,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 2,
                Management::NAME => 'Karol Nowak',
                Management::FUNCTION => 'Naczelnik',
                Management::UNIT_ID => 2,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 3,
                Management::NAME => 'Adam Nowak',
                Management::FUNCTION => 'Naczelnik',
                Management::UNIT_ID => 3,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 4,
                Management::NAME => 'Katarzyna Kowalska',
                Management::FUNCTION => 'Sekretarka',
                Management::UNIT_ID => 1,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 5,
                Management::NAME => 'Micha  Kowalski',
                Management::FUNCTION => 'Kierownik',
                Management::UNIT_ID => 2,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 6,
                Management::NAME => 'Justyna Nowak',
                Management::FUNCTION => 'Kierownik',
                Management::UNIT_ID => 3,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 7,
                Management::NAME => 'Piotr Nowak',
                Management::FUNCTION => 'Doradca',
                Management::UNIT_ID => 1,
            ]
        );

        DB::table(Management::TABLE_NAME)->insert(
            [
                Management::ID => 8,
                Management::NAME => 'Anna Kowalska',
                Management::FUNCTION => 'Doradca',
                Management::UNIT_ID => 2,
            ]
        );
    }
}
