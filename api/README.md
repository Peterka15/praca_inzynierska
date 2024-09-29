# Backend dla Portal OSP

# Setup projektu
## Baza danych
Wymagana jest baza danych MySQL w wersji 5 lub 8.
Dane dostępowe do bazy danych należy umieścić w pliku `.env`

## PHP
Wymagany jest PHP7.4. 

## Pierwsze uruchomienie projektu
1. `composer install` lub `php composer.phar install`
2. Migracja i seedy bazy danych `php artisan migrate:fresh --seed`
3. Uruchomienie serwera `php artisan serve`
4. Aplikacja będzie dostępna pod `http://localhost:80`

## IDE
Zalecane jest użycie PhpStorm.

## Generowanie opisów modeli
Użyj `php artisan ide-helper:models`.
Uzupełnienie słownika IDE `php artisan ide-helper:generate`.

# Komunikacja z API
Wszystkie elementy API zostały opisane w pliku OpenApi. Plik ten może zostać użyty jako:
- Import do aplikacji Postman, co wygeneruje wszystkie możliwe zapytania
- Import do edytora [Swagger](https://editor.swagger.io/), co pozwoli na przejrzenie dokumentacji w interaktywny sposób
- Wsad do generatora klientów API.

