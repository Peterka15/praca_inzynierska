<?php
declare(strict_types=1);

namespace Database\Seeders;


use App\Models\Managment;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\In;

class ManagmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Managment::TABLE_NAME)->insert(
            [
                Managment::ID => 1,
                Managment::NAME => 'Jan Kowalski',
                Managment::FUNCTION => 'Prezes',
                Managment::UNIT => 1,
                Managment::EMAIL => 'jkowalski@gmail.com'
            ]
        );

        DB::table(Managment::TABLE_NAME)->insert(
            [
                Managment::ID => 2,
                Managment::NAME => 'Karol Nowak',
                Managment::FUNCTION => 'Naczelnik',
                Managment::UNIT => 2,
                Managment::EMAIL => 'knowak@onet.pl'
            ]
        );
    }
}
