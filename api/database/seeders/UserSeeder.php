<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Enums\UserRole;
use App\Models\User;
use Carbon\Carbon;
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
                User::NAME => 'Tomek A.',
                User::EMAIL => 'admin@localhost',
                User::PASSWORD => Hash::make('admin123'),
                User::ROLE_ID => UserRole::ADMIN()->getValue(),
                User::UNIT_ID => 1,
                User::CREATED_AT => Carbon::now(),
                User::UPDATED_AT => Carbon::now(),
                User::PASSWORD_CHANGE_IS_REQUIRED => false,
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 2,
                User::NAME => 'Krzysztof M.',
                User::EMAIL => 'moderator@localhost',
                User::PASSWORD => Hash::make('moderator123'),
                User::ROLE_ID => UserRole::MODERATOR()->getValue(),
                User::UNIT_ID => 1,
                User::CREATED_AT => Carbon::now(),
                User::UPDATED_AT => Carbon::now(),
                User::PASSWORD_CHANGE_IS_REQUIRED => false,
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 3,
                User::NAME => 'Andrzej K.',
                User::EMAIL => 'komendant@localhost',
                User::PASSWORD => Hash::make('komendant123'),
                User::ROLE_ID => UserRole::COMMANDANT()->getValue(),
                User::UNIT_ID => 1,
                User::CREATED_AT => Carbon::now(),
                User::UPDATED_AT => Carbon::now(),
                User::PASSWORD_CHANGE_IS_REQUIRED => false,
            ]
        );

        DB::table(User::TABLE_NAME)->insert(
            [
                User::ID => 4,
                User::NAME => 'Strażak Sam',
                User::EMAIL => 'user@localhost',
                User::PASSWORD => Hash::make('user123'),
                User::ROLE_ID => UserRole::USER()->getValue(),
                User::UNIT_ID => 2,
                User::CREATED_AT => Carbon::now(),
                User::UPDATED_AT => Carbon::now(),
                User::PASSWORD_CHANGE_IS_REQUIRED => false,
            ]
        );
    }
}
