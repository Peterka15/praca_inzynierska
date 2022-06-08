<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Comment::TABLE_NAME)->insert(
            [
                [
                    Comment::ID => 1,
                    Comment::ARTICLE_ID => 1,
                    Comment::AUTHOR => 'Wiesława',
                    Comment::CONTENT => 'Bardzo dobrze!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 2,
                    Comment::ARTICLE_ID => 1,
                    Comment::AUTHOR => 'Babcia Jadzia',
                    Comment::CONTENT => 'Brawo chłopaki!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 3,
                    Comment::ARTICLE_ID => 2,
                    Comment::AUTHOR => 'Zygmunt',
                    Comment::CONTENT => 'Już od dawna tyle się nie działo we wsi!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 4,
                    Comment::ARTICLE_ID => 2,
                    Comment::AUTHOR => 'Sąsiad Władka',
                    Comment::CONTENT => 'A Władek to znów pali śmieciami!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
            ]
        );
    }
}
