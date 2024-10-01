<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 1,
                Role::NAME => 'Admin',
            ]
        );

        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 2,
                Role::NAME => 'Moderator',
            ]
        );
        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 3,
                Role::NAME => 'User',
            ]
        );
        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 4,
                Role::NAME => 'Commandant',
            ]
        );
        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 5,
                Role::NAME => 'Public',
            ]
        );
        DB::table(Role::TABLE_NAME)->insert(
            [
                Role::ID => 6,
                Role::NAME => 'Disabled',
            ]
        );
    }
}
