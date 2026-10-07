# Setlist

An archive for recorded DJ sets, built with Laravel as a course project for
**Software Development Basics (MTM_03.1)** at CODE University of Applied
Sciences, Berlin.

## What it does

- Anyone can browse, search and listen to every set — no account needed
- Registered users upload their own sets with cover art, genre, BPM and a description
- Audio is drawn as a waveform (wavesurfer.js) instead of a plain player
- Every set has a comment thread
- Only the uploader can edit or delete a set, enforced by a policy
- Search covers set title, genre and DJ name

## Data model

| Relationship | Type |
|---|---|
| `User` has many `Mix` | 1-N |
| `Mix` has many `Comment` | 1-N |
| `User` has many `Comment` | 1-N |
| `User` reaches the comments on their own sets | `hasManyThrough` |

A `Mix` belongs to the `User` who uploaded it; a `Comment` belongs to both a
`Mix` and the `User` who wrote it.

## Installation

```
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
```

The last command is required so uploaded audio and images are served. The
`public/storage` symlink is not part of the repository.

## Test accounts

| Role | Email | Password |
|---|---|---|
| Admin | admin@admin.com | password |
| Second DJ | johnny@setlist.test | password |

The second account exists so that the ownership rules are visible: logged in
as one user, the edit and delete controls on the other user's sets are gone,
and calling the edit URL directly returns 403.

## A note on media files

Uploaded files live in `storage/app/public`, which is excluded from the
repository. Three 60-second excerpts from my own sets ship in
`database/seeders/demo` instead, so a fresh `php artisan migrate:fresh --seed`
produces six sets with real audio, covers and matching BPM. The seeder copies
them onto the public disk, so run `php artisan storage:link` once beforehand.