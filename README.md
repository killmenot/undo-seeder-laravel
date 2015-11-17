# Undo Seeder for Laravel

Features
========

- Allows to have up and down method for every seed Allows you to seed databases in different environments with different values.


Use
=====
When you install UndoSeeder, the following artisan commands are made available:

<table>
<tr><td>db:seed-undo</td><td>Undo seeds in the seeds directory.</td></tr>
<tr><td>db:seed-refresh</td><td>Undo seeds run seeds again.</td></tr>
</table>

Installation
============

- Add require: `"killmenot/undo-seeder-laravel": "dev-master"` to your composer.json and run an update to bring it in (or run composer require killmenot/undo-seeder-laravel).
- Add `Intspirit\UndoSeeder\UndoSeederServiceProvider::class` to your providers array in app/config/app.php
