# Praktiskais darbs 2 - Laravel (grāmatu bibliotēka)

Tēma: personīgā grāmatu bibliotēka. Katrs lietotājs redz tikai savas grāmatas.

## Prasības un kur tās atrodas

| Prasība | Kur |
|---|---|
| Autentifikācija | Laravel Breeze (login, register, profils) |
| 2 saistīti modeļi | `Genre` (1) -> (daudzas) `Book`, `Book` pieder `User` - `app/Models` |
| Pilna CRUD | `Book` - `app/Http/Controllers/BookController.php` |
| Seeders | `database/seeders` (DatabaseSeeder, GenreSeeder, BookSeeder) |
| AJAX | `resources/views/books/index.blade.php` - meklēšana + izlasīta/neizlasīta poga |
| Blade | `resources/views/books/*`, layout `x-app-layout` |
| Validācija | `BookController::rules()` + kļūdu paziņojumi formā |

## Uzstādīšana uz Ubuntu (22.04 / 24.04)

### 1. Programmas

```bash
sudo apt update
sudo apt install -y software-properties-common curl unzip git
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-sqlite3 php8.3-bcmath php8.3-intl

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js 20
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

Pārbaude: `php -v` (vajag 8.2 vai jaunāku), `composer -V`, `node -v`.

### 2. Projekts

```bash
unzip laravel-praktiskais2.zip
cd laravel-praktiskais2
bash setup.sh
```

Skripts pats: izveido Laravel projektu mapē `biblioteka`, uzliek Breeze, nokopē mūsu failus, izveido SQLite datubāzi, nobuildo CSS/JS un palaiž migrācijas ar seeders.

### 3. Palaišana

```bash
cd biblioteka
php artisan serve
```

Atver http://127.0.0.1:8000

Ja tas ir VM un atver no cita datora: `php artisan serve --host=0.0.0.0`

Demo lietotājs: **demo@example.com** / **password**

Datubāzes atiestatīšana: `php artisan migrate:fresh --seed`

## Git (1 punkts)

```bash
cd biblioteka
git init
git add .
git commit -m "Pirmais commit"
```

