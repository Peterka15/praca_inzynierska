<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(ArticleTag::TABLE_NAME)->insert(
            [
                [
                    ArticleTag::ID => 1,
                    ArticleTag::TAG_ID => 1,
                    ArticleTag::ARTICLE_ID => 1,
                ],
                [
                    ArticleTag::ID => 2,
                    ArticleTag::TAG_ID => 4,
                    ArticleTag::ARTICLE_ID => 1,
                ],
                [
                    ArticleTag::ID => 3,
                    ArticleTag::TAG_ID => 3,
                    ArticleTag::ARTICLE_ID => 2,
                ],
            ]
        );
    }
}
