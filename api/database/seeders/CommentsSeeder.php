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
                [
                    Comment::ID => 5,
                    Comment::ARTICLE_ID => 3,
                    Comment::AUTHOR => 'Marek',
                    Comment::CONTENT => 'To była najbardziej szalona akcja, jaką widziałem – płomienie zdawały się tańczyć dziwaczny taniec!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 6,
                    Comment::ARTICLE_ID => 4,
                    Comment::AUTHOR => 'Entuzjastka',
                    Comment::CONTENT => 'Ćwiczenia? Bardziej przypominały cyrkowe sztuczki niż poważny trening – totalny absurd!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 7,
                    Comment::ARTICLE_ID => 5,
                    Comment::AUTHOR => 'Krytyk',
                    Comment::CONTENT => 'Gaszenie pożaru na dachu to totalny nonsens. Co oni w ogóle myśleli, wymyślając tę akcję?',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 8,
                    Comment::ARTICLE_ID => 6,
                    Comment::AUTHOR => 'Zaskoczona',
                    Comment::CONTENT => 'Ratowanie kota z drzewa? Absolutnie surrealistyczne – mieszanka zachwytu i niedowierzania!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 9,
                    Comment::ARTICLE_ID => 7,
                    Comment::AUTHOR => 'Jan',
                    Comment::CONTENT => 'Kaczka uwięziona w fontannie... aż trudno w to uwierzyć!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 10,
                    Comment::ARTICLE_ID => 1,
                    Comment::AUTHOR => 'Ironia',
                    Comment::CONTENT => 'Nowy Jelecz to raczej nowy absurd. Niby prezent, ale całkowicie niepraktyczny!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 11,
                    Comment::ARTICLE_ID => 2,
                    Comment::AUTHOR => 'Robert',
                    Comment::CONTENT => 'Pożar w szopie wywołuje we mnie gniew – czy naprawdę trzeba było dopuścić do takiej katastrofy?',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 12,
                    Comment::ARTICLE_ID => 3,
                    Comment::AUTHOR => 'Emocjonalna Beata',
                    Comment::CONTENT => 'Widok płonącej stodoły wzbudził we mnie mieszankę przerażenia i fascynacji – totalne sprzeczności!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 13,
                    Comment::ARTICLE_ID => 4,
                    Comment::AUTHOR => 'Wojciech',
                    Comment::CONTENT => 'Ćwiczenia z użyciem wody? Marnotrawstwo czasu, kiedy można zrobić coś naprawdę pożytecznego.',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
                [
                    Comment::ID => 14,
                    Comment::ARTICLE_ID => 7,
                    Comment::AUTHOR => 'Grażyna Zszokowana',
                    Comment::CONTENT => 'Kaczka z fontanny to tylko przykrywka dla współczesnych absurdów – więcej tragedii niż komedii!',
                    Comment::CREATED_AT => Date::now(),
                    Comment::UPDATED_AT => Date::now(),
                ],
            ]
        );
    }
}
