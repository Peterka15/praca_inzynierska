<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 1,
                User::NAME => 'admin',
                User::EMAIL => 'admin@localhost',
                User::PASSWORD => Hash::make('admin123'),
                User::CREATED_AT => Date::now(),
                User::UPDATED_AT => Date::now(),
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 2,
                User::NAME => 'Strażak Sam',
                User::EMAIL => 'sam@osp',
                User::PASSWORD => Hash::make('strazaksam'),
                User::CREATED_AT => Date::now(),
                User::UPDATED_AT => Date::now(),
            ]
        );
    }
}
