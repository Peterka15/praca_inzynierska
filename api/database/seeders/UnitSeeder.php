<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Unit::TABLE_NAME)->insert(
            [
                Unit::ID => 1,
                Unit::NAME => 'OSP ZAWADA',
            ]
        );

        DB::table(Unit::TABLE_NAME)->insert(
            [
                Unit::ID => 2,
                Unit::NAME => 'OSP PSZÓW',
            ]
        );
        DB::table(Unit::TABLE_NAME)->insert(
            [
                Unit::ID => 3,
                Unit::NAME => 'OSP KRZYŻKOWICE',
            ]
        );
        DB::table(Unit::TABLE_NAME)->insert(
            [
                Unit::ID => 4,
                Unit::NAME => 'OSP LUBOMIA',
            ]
        );
        DB::table(Unit::TABLE_NAME)->insert(
            [
                Unit::ID => 5,
                Unit::NAME => 'OSP SYRYNIA',
            ]
        );
    }
}
