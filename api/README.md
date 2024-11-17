# Backend dla Portal OSP

# TODO
- [x] Tworzenie użytkowników przed administratora / moderatora
- [x] Edycja użytkownika
- [x] Usuwanie użytkownika
- [x] Rejestracja przez przesłanie linku z tokenem
- [x] Zmiana hasła przez przesłanie linku z tokenem
- [x] Kontroler do materiałów szkoleniowych (files)
- [x] Kontroler do wyposażenia i kategorii - `InventoryController / InventoryCategoryController`
- [x] Kontroler do wyświetlania / modyfikacji zarządu
- [ ] Uprawniania
  - [ ] Artykuły
    - GET: Publiczne
    - POST: Moderator tylko swoje OSP, Administrator
    - PATCH: Moderator tylko swoje OSP, Administrator
    - DELETE: Moderator tylko swoje OSP, Administrator
  - [ ] Auth
    - login: Publiczne
    - logout: Publiczne
    - setPassword: Publiczne
    - POST: Administrator
    - PATCH: Administrator
    - DELETE: Administrator
  - [ ] Komentarze
    - GET: Publiczne
    - POST: Publiczne
    - PATCH: nikt (nie ma sensu, żeby ktokolwiek mógł edytować komentarz)
    - DELETE: Moderator tylko swoje OSP, Administrator
  - [ ] Pliki
    - GET: Niepubliczne (po zalogowaniu), Komandant i Admin wszystko, Moderator i user tylko swoje OSP
    - POST: Moderator tylko swoje OSP, Administrator
    - PATCH: Moderator tylko swoje OSP, Administrator
    - DELETE: Moderator tylko swoje OSP, Administrator
  - [ ] Zdjęcia
    - GET: Publiczne
    - POST: Moderator tylko swoje OSP, Administator
    - PATCH: Moderator tylko swoje OSP, Administator
    - DELETE: Moderator tylko swoje OSP, Administator
  - [ ] Zarząd
    - GET: Publiczne
    - POST: Moderator tylko swoje OSP, Administator
    - PATCH: Moderator tylko swoje OSP, Administator
    - DELETE: Moderator tylko swoje OSP, Administator
  - [ ] Role
    - GET: Publiczne
    - POST: Administator
    - PATCH: Administator
    - DELETE: Administator
  - [ ] Tagi
    - GET: Publiczne
    - POST: Moderator tylko swoje OSP, Administator
    - PATCH: Moderator tylko swoje OSP, Administator
    - DELETE: Moderator tylko swoje OSP, Administator
  - [ ] Jednostki
    - GET: Publiczne
    - POST: Administator
    - PATCH: Administator (Moderator tylko swoje OSP - tu raczej nie ma sensu)
    - DELETE: Administator
  - [ ] Użytkownicy
    - GET: Niepubliczne (po zalogowaniu)
    - POST: Moderator tylko swoje OSP, Administrator
    - PATCH: Moderator tylko swoje OSP, Administrator
    - DELETE: Moderator tylko swoje OSP, Administrator
    - resetPassword: Administrator
  - [ ] Wyposażenie
    - GET: Niepubliczne (po zalogowaniu), Komandant i Admin wszystko, Moderator i user tylko swoje OSP
    - POST: Moderator tylko swoje OSP, Administrator
    - PATCH: Moderator tylko swoje OSP, Administrator
    - DELETE: Moderator tylko swoje OSP, Administrator
  - [ ] Materiały szkoleniowe
    - GET: Niepubliczne (po zalogowaniu)
    - POST: Moderator tylko swoje OSP, Administrator
    - PATCH: Moderator tylko swoje OSP, Administrator
    - DELETE: Moderator tylko swoje OSP, Administrator

# Setup projektu
## Docker
Docker cię wybawi. Nie opieraj się. Uwierz w dockera (ale trzeba go na początku zainstalować, najlepiej pod WSL).
Docker sam postawi php7.4 i mysql8.
Docker sam odpali `php artisan serve` na porcie 8090.

```bash
# Start kontenera
docker-compose up -d
# Wejście do kontenera jako bash (do ręcznego wywoływania komend)
docker exec -it api bash
```

API będzie dostępne pod `http://localhost:8090/api`.

## Baza danych
Wymagana jest baza danych MySQL w wersji 5 lub 8.
Dane dostępowe do bazy danych należy umieścić w pliku `.env`

## PHP
Wymagany jest PHP7.4.

## Pierwsze uruchomienie projektu
1. `composer install` lub `php composer.phar install` (docker zrobi to sam)
2. Migracja i seedy bazy danych `php artisan migrate:fresh --seed`
3. Uruchomienie serwera `php artisan serve` (docker zrobi to sam)
4. Aplikacja będzie dostępna pod `http://localhost:80` (pod docker na `http://localhost:8090`)

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

