<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(Article::TABLE_NAME)->insert(
            [
                [
                    Article::ID => 1,
                    Article::AUTHOR_ID => 1,
                    Article::TITLE => 'Nowy Jelecz dla OSP!',
                    Article::CONTENT => '<p>Nasza jednostka otrzymała pojazd marki Jelecz, nowiutki!</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
                [
                    Article::ID => 2,
                    Article::AUTHOR_ID => 2,
                    Article::TITLE => 'Pożar w szopie u Włodzimierza',
                    Article::CONTENT => '<b>Pożar!</b><p>W piątkowe popołudnie doszło do pożaru na Konwaliowej 13.</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ]
            ]
        );
    }
}
