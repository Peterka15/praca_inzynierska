<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Tag::TABLE_NAME)->insert(
            [
                [
                    Tag::ID => 1,
                    Tag::NAME => 'Sprzęt',
                ],
                [
                    Tag::ID => 2,
                    Tag::NAME => 'Wydarzenia',
                ],
                [
                    Tag::ID => 3,
                    Tag::NAME => 'Pożar',
                ],
                [
                    Tag::ID => 4,
                    Tag::NAME => 'Załoga',
                ]
            ]
        );
    }
}
