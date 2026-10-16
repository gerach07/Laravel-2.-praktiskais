#!/usr/bin/env bash
# Izveido Laravel projektu "biblioteka", uzliek Breeze un pievieno mūsu failus.
set -e

cd "$(dirname "$0")"
HERE=$(pwd)

composer create-project laravel/laravel biblioteka --no-interaction
cd biblioteka

composer require laravel/breeze --dev --no-interaction
php artisan breeze:install blade --no-interaction

# mūsu faili (modeļi, kontrolieris, skati, seeders, routes)
cp -r "$HERE/overlay/." .

# SQLite datubāze
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$(pwd)/database/database.sqlite|" .env
touch database/database.sqlite

# saite "Grāmatas" navigācijā
perl -0pi -e 's|</x-nav-link>|</x-nav-link>\n                <x-nav-link :href="route(\x27books.index\x27)" :active="request()->routeIs(\x27books.*\x27)">\n                    Grāmatas\n                </x-nav-link>|' resources/views/layouts/navigation.blade.php

npm install
npm run build

php artisan migrate:fresh --seed --force

echo ""
echo "Gatavs! Palaid:  cd biblioteka && php artisan serve"
echo "Lietotājs: demo@example.com   Parole: password"
