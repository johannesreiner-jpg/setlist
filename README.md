# Setlist

A music library and DJ set archive built with Laravel.

Course project for **Software Development Basics (MTM_03.1)**
at CODE University of Applied Sciences.

## What it does

Visitors browse songs, artists and genres and move between them through
linked detail pages. Registered users upload their own DJ sets together
with a tracklist, and see how often their tracks get played. Every track
in a tracklist links out to where it can be streamed or bought —
Spotify, SoundCloud, Bandcamp.

## Status

Work in progress.

- [x] Public layout with shared header and footer
- [x] Authentication (login, registration, profile)
- [ ] Songs, artists and genres
- [ ] DJ sets with tracklists
- [ ] Play tracking and user dashboard
- [ ] Admin area

## Stack

Laravel 13 · PHP 8.4 · Blade · Tailwind CSS · Alpine.js · SQLite · Pest

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

Serve the folder with [Laravel Herd](https://herd.laravel.com)
and open `http://setlist.test`.

## Credits

Built on the educational Laravel starter pack provided for this course.