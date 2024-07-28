<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UnitsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 1,
                User::NAME => 'Admin',
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 2,
                User::NAME => 'Moderator',
            ]
        );
        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 3,
                User::NAME => 'USER',
            ]
        );
        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 4,
                User::NAME => 'Komendant',
            ]
        );
        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 5,
                User::NAME => 'Public',
            ]
        );
    }
}
