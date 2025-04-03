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
        DB::table(Comment::TABLE_NAME)->insert([
            [
                Comment::ID => 1,
                Comment::ARTICLE_ID => 1,
                Comment::AUTHOR => 'Wiesława',
                Comment::CONTENT => 'W końcu coś nowego dla naszych strażaków! Oby dobrze służył i zawsze wracał cały.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 2,
                Comment::ARTICLE_ID => 1,
                Comment::AUTHOR => 'Babcia Jadzia',
                Comment::CONTENT => 'Brawo chłopaki! Jelcz wygląda jak z przyszłości, oby nie musiał zbyt często wyjeżdżać.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 3,
                Comment::ARTICLE_ID => 1,
                Comment::AUTHOR => 'Roman z sąsiedztwa',
                Comment::CONTENT => 'A może teraz jakaś impreza z okazji nowego nabytku? Ludzie chcą zobaczyć Jelcza z bliska!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 4,
                Comment::ARTICLE_ID => 2,
                Comment::AUTHOR => 'Zygmunt',
                Comment::CONTENT => 'Już od dawna tyle się nie działo we wsi! Cała okolica zbiegła się oglądać akcję!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 5,
                Comment::ARTICLE_ID => 2,
                Comment::AUTHOR => 'Sąsiad Władka',
                Comment::CONTENT => 'A Władek to znów palił plastikiem... może teraz w końcu dostanie nauczkę.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 6,
                Comment::ARTICLE_ID => 2,
                Comment::AUTHOR => 'Ela z Konwaliowej',
                Comment::CONTENT => 'Całe szczęście, że strażacy przyjechali tak szybko. Szopa to jedno, ale dom był tuż obok!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 7,
                Comment::ARTICLE_ID => 3,
                Comment::AUTHOR => 'Marek',
                Comment::CONTENT => 'To była najbardziej szalona akcja, jaką widziałem – płomienie zdawały się tańczyć nad dachem!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 8,
                Comment::ARTICLE_ID => 3,
                Comment::AUTHOR => 'Emocjonalna Beata',
                Comment::CONTENT => 'Widok płonącej stodoły wzbudził we mnie przerażenie, ale i podziw dla sprawności strażaków.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 9,
                Comment::ARTICLE_ID => 4,
                Comment::AUTHOR => 'Entuzjastka',
                Comment::CONTENT => 'Ćwiczenia? Bardziej przypominały widowisko pokazowe – ale przynajmniej dzieci miały frajdę!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 10,
                Comment::ARTICLE_ID => 4,
                Comment::AUTHOR => 'Wojciech',
                Comment::CONTENT => 'Woda lała się strumieniami, aż zalali mi ogródek. Ale ważne, że ćwiczą.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 11,
                Comment::ARTICLE_ID => 5,
                Comment::AUTHOR => 'Krytyk',
                Comment::CONTENT => 'Gaszenie pożaru na dachu? Brzmi jak z filmu akcji. Szacunek dla odwagi, ale pytania pozostają.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 12,
                Comment::ARTICLE_ID => 5,
                Comment::AUTHOR => 'Alicja',
                Comment::CONTENT => 'Byłam tam i widziałam wszystko – drabina sięgała nieba! Dobrze, że skończyło się bez strat.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 13,
                Comment::ARTICLE_ID => 6,
                Comment::AUTHOR => 'Zaskoczona',
                Comment::CONTENT => 'Ratowanie kota z drzewa? Urocze i potrzebne. Zwierzak był naprawdę przerażony!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 14,
                Comment::ARTICLE_ID => 6,
                Comment::AUTHOR => 'Mały Karol',
                Comment::CONTENT => 'To był mój kotek! Dziękuję strażakom, jesteście bohaterami!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 15,
                Comment::ARTICLE_ID => 7,
                Comment::AUTHOR => 'Jan',
                Comment::CONTENT => 'Kaczka uwięziona w fontannie... a jednak życie potrafi zaskakiwać! Brawo za refleks!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 16,
                Comment::ARTICLE_ID => 7,
                Comment::AUTHOR => 'Grażyna Zszokowana',
                Comment::CONTENT => 'Jak w ogóle można było wpaść do rury? Ale dobrze, że się nią zajęliście!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 17,
                Comment::ARTICLE_ID => 7,
                Comment::AUTHOR => 'Biolog-amator',
                Comment::CONTENT => 'Kaczki często eksplorują nowe miejsca, ale fontanna to nie jezioro. Świetna robota z ratunkiem!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 18,
                Comment::ARTICLE_ID => 1,
                Comment::AUTHOR => 'Ironia',
                Comment::CONTENT => 'Nowy Jelcz wygląda fajnie, ale czy naprawdę potrzebny? Wciąż nie mamy porządnego garażu...',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 19,
                Comment::ARTICLE_ID => 2,
                Comment::AUTHOR => 'Robert',
                Comment::CONTENT => 'Pożar w szopie to nie żarty – dobrze, że nikt nie ucierpiał. Trzeba więcej edukacji o bezpieczeństwie!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 20,
                Comment::ARTICLE_ID => 4,
                Comment::AUTHOR => 'Inż. Marian',
                Comment::CONTENT => 'Ćwiczenia jak najbardziej na plus – mam tylko nadzieję, że nie zużyli całej wody z hydrantów.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 21,
                Comment::ARTICLE_ID => 5,
                Comment::AUTHOR => 'Nina',
                Comment::CONTENT => 'Nie codziennie widzi się strażaków na dachu ratusza. Odważni i skuteczni – wielki szacun!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 22,
                Comment::ARTICLE_ID => 3,
                Comment::AUTHOR => 'Rolnik Janek',
                Comment::CONTENT => 'Stracić stodołę to tragedia... Ale dzięki wam nie poszła cała zagroda z dymem. Dziękuję!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 23,
                Comment::ARTICLE_ID => 6,
                Comment::AUTHOR => 'Asia',
                Comment::CONTENT => 'Niech mi ktoś powie, że strażacy tylko gaszą pożary. Tu pokazali, że mają serce też dla zwierząt!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 24,
                Comment::ARTICLE_ID => 2,
                Comment::AUTHOR => 'Anonim',
                Comment::CONTENT => 'Plotki mówią, że to było podpalenie… Ciekawe, czy znajdą sprawcę.',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
            [
                Comment::ID => 25,
                Comment::ARTICLE_ID => 7,
                Comment::AUTHOR => 'Kasia z dzieciakami',
                Comment::CONTENT => 'Moje dzieci były zachwycone akcją z kaczką. Mówią, że strażacy to teraz ich bohaterowie!',
                Comment::CREATED_AT => Date::now(),
                Comment::UPDATED_AT => Date::now(),
            ],
        ]);
    }
}
