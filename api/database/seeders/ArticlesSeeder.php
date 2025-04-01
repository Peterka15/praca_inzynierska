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
                    Article::TITLE => 'Nowy Jelcz dla OSP!',
                    Article::CONTENT => '<p>Nasza jednostka otrzymała pojazd marki Jelcz, nowiutki!</p>',
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
                ],
                [
                    Article::ID => 3,
                    Article::AUTHOR_ID => 1,
                    Article::TITLE => 'Pożar w stodole u Piotra',
                    Article::CONTENT => '<p>W sobotni wieczór doszło do pożaru w stodole u Piotra.</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
                [
                    Article::ID => 4,
                    Article::AUTHOR_ID => 2,
                    Article::TITLE => 'Ćwiczenia z użyciem wody',
                    Article::CONTENT => '<p>W minionym tygodniu nasza jednostka przeprowadziła ćwiczenia z użyciem wody.</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
                [
                    Article::ID => 5,
                    Article::AUTHOR_ID => 2,
                    Article::TITLE => 'Gaszenie pożaru na dachu ratusza!',
                    Article::CONTENT => '<p>Nasi dzielni strażacy wspięli się na dach ratusza, aby ugasić płonący komin. Akcja zakończyła się sukcesem!</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
                [
                    Article::ID => 6,
                    Article::AUTHOR_ID => 1,
                    Article::TITLE => 'Kotek na drzewie uratowany!',
                    Article::CONTENT => '<p>W sobotnie popołudnie strażacy ruszyli na ratunek przestraszonemu kotkowi, który utknął na najwyższej gałęzi dębu w parku. Uratowali go z użyciem drabiny i wrócili z czworonogiem na ziemię.</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
                [
                    Article::ID => 7,
                    Article::AUTHOR_ID => 2,
                    Article::TITLE => 'Strażacy uratowali kaczkę z fontanny!',
                    Article::CONTENT => '<p>Nasza jednostka musiała interweniować, gdy ciekawska kaczka utknęła w rury fontanny na rynku. Po godzinnej operacji, kaczka została bezpiecznie wyciągnięta i wypuszczona na wolność.</p>',
                    Article::CREATED_AT => Date::now(),
                    Article::UPDATED_AT => Date::now(),
                ],
            ]
        );
    }
}
