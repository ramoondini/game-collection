# Game Collection

Game Collection ir Laravel tīmekļa lietotne, kas paredzēta spēļu kolekcijas apskatei un pārvaldībai. Projektā lietotājs var apskatīt spēles, izmantot lietotāja kontu un strādāt ar datiem, kas tiek saglabāti datubāzē.

## Projekta mērķis

Projekta mērķis ir izveidot funkcionējošu tīmekļa lietotni, izmantojot Laravel ietvaru, datubāzi un Blade skatu sistēmu. Lietotne demonstrē darbu ar maršrutiem, kontrolieriem, modeļiem, skatiem un datubāzes tabulām.

## Izmantotās tehnoloģijas

* PHP
* Laravel
* MySQL
* Blade
* Tailwind CSS
* Vite
* WAMP
* Adminer
* Git

## Galvenā funkcionalitāte

* Lietotāju reģistrācija un pieslēgšanās
* Spēļu saraksta apskate
* Spēļu informācijas attēlošana
* Spēļu un lietotāju datu saglabāšana datubāzē
* Komentāru un vērtējumu tabulas
* Laravel migrācijas un seeders
* Datubāzes eksports SQL formātā

## Projekta struktūra

Svarīgākās projekta mapes:

* `app/` – modeļi, kontrolieri un lietotnes loģika
* `database/` – migrācijas, seeders, factories un datubāzes eksports
* `resources/views/` – Blade skatu faili
* `resources/css/` – stila faili
* `routes/` – tīmekļa maršruti
* `public/` – publiski pieejamie faili
* `config/` – Laravel konfigurācijas faili

## Projekta uzstādīšana lokāli

1. Lejupielādēt vai noklonēt projektu.

```bash
git clone https://github.com/ramoondini/game-collection.git
```

2. Ieiet projekta mapē.

```bash
cd game-collection
```

3. Instalēt PHP dependencies.

```bash
composer install
```

4. Instalēt frontend dependencies.

```bash
npm install
```

5. Izveidot `.env` failu no `.env.example`.

```bash
copy .env.example .env
```

6. Ģenerēt Laravel aplikācijas atslēgu.

```bash
php artisan key:generate
```

7. Konfigurēt datubāzes pieslēgumu `.env` failā.

Piemērs:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=game_collection
DB_USERNAME=root
DB_PASSWORD=
```

8. Izveidot datubāzi `game_collection` Adminer vai phpMyAdmin vidē.

9. Importēt datubāzes eksportu no faila:

```text
database/game_collection.sql
```

Vai arī palaist migrācijas:

```bash
php artisan migrate
```

Ja nepieciešami sākuma dati:

```bash
php artisan db:seed
```

10. Palaist frontend kompilāciju.

```bash
npm run dev
```

11. Palaist Laravel serveri.

```bash
php artisan serve
```

Pēc tam projektu var atvērt pārlūkā:

```text
http://127.0.0.1:8000
```

## Datubāze

Projektā tiek izmantota MySQL datubāze ar nosaukumu `game_collection`. Datubāzes struktūra ir veidota ar Laravel migrācijām, un papildus ir pievienots SQL eksporta fails.

Datubāzes mapē atrodas:

* `migrations/` – tabulu struktūra
* `seeders/` – sākuma dati
* `factories/` – testa datu ģenerēšana
* `game_collection.sql` – datubāzes eksports

## Piezīmes

Projektā netiek pievienotas mapes `vendor/` un `node_modules/`, jo tās tiek ģenerētas pēc dependencies instalēšanas. Tāpat netiek pievienots `.env` fails, jo tajā var atrasties lokālās vides konfigurācija.

## Autors

Reimonds
Petrovskis
rp25040