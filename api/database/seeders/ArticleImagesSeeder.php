<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Image;
use Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleImagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Image::TABLE_NAME)->insert(
            [
                [
                    Image::ID => 1,
                    Image::UUID => '553c9ca2-a4c2-48df-b864-a420ded3262f',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 7,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
                [
                    Image::ID => 2,
                    Image::UUID => '1b378cc5-9069-4543-9d08-8e6b7427aa4e',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 2,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
                [
                    Image::ID => 3,
                    Image::UUID => 'bc6ced2b-c27e-425f-937e-366576a5585f',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 3,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
                [
                    Image::ID => 4,
                    Image::UUID => 'e77fbbad-b14c-44e3-982a-4ba0a5194fd9',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 4,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
                [
                    Image::ID => 5,
                    Image::UUID => '94966119-bf6e-4e20-b939-84545f502c0c',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 5,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
                [
                    Image::ID => 6,
                    Image::UUID => '8bb3b63a-209b-4ada-8274-2bb312850225',
                    Image::MIME_TYPE => 'image/webp',
                    Image::ARTICLE_ID => 6,
                    Image::CREATED_AT => Date::now(),
                    Image::UPDATED_AT => Date::now()
                ],
            ]
        );
    }
}
