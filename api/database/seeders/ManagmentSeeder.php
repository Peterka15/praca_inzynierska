<?php
declare(strict_types=1);

namespace Database\Seeders;


use App\Models\Management;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\In;

class ManagmentSeeder extends Seeder
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
    }
}
