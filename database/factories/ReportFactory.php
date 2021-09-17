<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'external_id' => $faker->uuid(),
        'title' => $faker->words(5, true),
        'url' => $faker->url(),
        'summary' => $faker->text()
    ];
});
