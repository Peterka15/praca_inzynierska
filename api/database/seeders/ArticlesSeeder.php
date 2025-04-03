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
        DB::table(Article::TABLE_NAME)->insert([
            [
                Article::ID => 1,
                Article::AUTHOR_ID => 1,
                Article::TITLE => 'Nowy Jelcz dla OSP!',
                Article::CONTENT => '<p>Nasza jednostka wzbogaciła się o nowoczesny pojazd gaśniczy marki Jelcz, który znacząco zwiększy nasze możliwości operacyjne. Pojazd wyposażony jest w zbiornik o pojemności 3000 litrów, najnowszą aparaturę łączności oraz sprzęt ratowniczy.</p><p>Uroczyste przekazanie odbyło się na placu jednostki w obecności władz gminy i mieszkańców. Wierzymy, że Jelcz posłuży naszej społeczności przez wiele lat!</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 2,
                Article::AUTHOR_ID => 2,
                Article::TITLE => 'Pożar w szopie u Włodzimierza',
                Article::CONTENT => '<b>Pożar!</b><p>W piątkowe popołudnie, około godziny 17:00, doszło do groźnego pożaru w przydomowej szopie przy ulicy Konwaliowej 13. Na miejscu błyskawicznie pojawiły się dwa zastępy naszej jednostki.</p><p>Ogień objął drewnianą konstrukcję oraz składowane w niej materiały. Dzięki szybkiej interwencji udało się zapobiec rozprzestrzenieniu ognia na pobliski budynek mieszkalny. Przyczynę pożaru ustala policja.</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 3,
                Article::AUTHOR_ID => 1,
                Article::TITLE => 'Pożar w stodole u Piotra',
                Article::CONTENT => '<p>W sobotni wieczór nasza jednostka została wezwana do pożaru stodoły w gospodarstwie Piotra, przy ul. Polnej. Pożar był już rozwinięty, a płomienie widoczne były z odległości kilkuset metrów.</p><p>Akcja trwała ponad dwie godziny. Strażacy skupili się na zabezpieczeniu sąsiednich budynków i ugaszeniu ognia. Niestety, straty materialne są duże – spłonęło wyposażenie oraz część plonów. Na szczęście nikt nie ucierpiał.</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 4,
                Article::AUTHOR_ID => 2,
                Article::TITLE => 'Ćwiczenia z użyciem wody',
                Article::CONTENT => '<p>W minionym tygodniu nasza jednostka przeprowadziła ćwiczenia z zakresu gaszenia pożarów przy użyciu różnych technik wodnych. Zajęcia odbyły się na terenie zalewu i obejmowały zarówno działania liniowe, jak i zasilanie z punktów oddalonych.</p><p>Ćwiczenia miały na celu poprawę koordynacji między zastępami i przetestowanie nowego sprzętu. Dziękujemy wszystkim druhom za zaangażowanie!</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 5,
                Article::AUTHOR_ID => 2,
                Article::TITLE => 'Gaszenie pożaru na dachu ratusza!',
                Article::CONTENT => '<p>W niedzielne popołudnie doszło do groźnego incydentu – zapalił się komin na dachu ratusza miejskiego. Nasza jednostka została zaalarmowana o godzinie 14:15 i niezwłocznie przystąpiła do działań.</p><p>Akcja wymagała wykorzystania drabiny mechanicznej oraz aparatów ochrony dróg oddechowych. Dzięki sprawnej akcji ogień został szybko opanowany, a konstrukcja dachu nie została poważnie uszkodzona.</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 6,
                Article::AUTHOR_ID => 1,
                Article::TITLE => 'Kotek na drzewie uratowany!',
                Article::CONTENT => '<p>W sobotnie popołudnie mieszkańcy parku miejskiego zauważyli przestraszonego kotka, który utknął na jednej z najwyższych gałęzi starego dębu. Zaalarmowano naszą jednostkę, która przybyła na miejsce z drabiną ratowniczą.</p><p>Akcja przebiegła sprawnie – jeden z druhów wspiął się na drzewo i bezpiecznie sprowadził czworonoga na ziemię. Kotek szybko znalazł swojego właściciela, który z wdzięcznością odebrał pupila. Dziękujemy za wzorową postawę!</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
            [
                Article::ID => 7,
                Article::AUTHOR_ID => 2,
                Article::TITLE => 'Strażacy uratowali kaczkę z fontanny!',
                Article::CONTENT => '<p>W środowe popołudnie nasza jednostka została wezwana do nietypowej interwencji – kaczka zaklinowała się w rurze odpływowej fontanny na rynku. Zwierzę nie mogło się wydostać, a próby mieszkańców spełzły na niczym.</p><p>Po godzinnej operacji z użyciem specjalistycznych narzędzi udało się bezpiecznie wydobyć kaczkę. Zwierzę było przemoczone, ale całe i zdrowe – po chwili odpoczynku zostało wypuszczone na pobliski staw. Interwencja zakończyła się sukcesem i... brawami od przechodniów!</p>',
                Article::CREATED_AT => Date::now(),
                Article::UPDATED_AT => Date::now(),
            ],
        ]);
    }
}
