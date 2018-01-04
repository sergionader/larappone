<?php

use Faker\Generator as Faker;

$factory->define(App\Visit::class, function (Faker $faker) {
    $dt = $faker->date($format = 'Y-m-d', $max = 'now');
    return [
        'unit' => 'TT',
        'dt' => $dt,
        'dt_unix' => $faker->unixTime($dt),
        'month_year' => $faker->year($max = 'now') . $faker->month($max = 'now'),
        'tm' => $faker->time($format = 'H:i:s', $max = 'now'),
        'tm_unix' => strtotime($faker->time($format = 'H:i:s', $max = 'now')),
        'profile_id' => rand(1, 10),
        'origin_id' => rand(1, 9),
        'avg' => $faker->biasedNumberBetween($min = 60, $max = 100),
        'max' => $faker->biasedNumberBetween($min = 60, $max = 100),
        'min' => $faker->biasedNumberBetween($min = 60, $max = 100),
        'min' => $faker->biasedNumberBetween($min = 60, $max = 100),
        'prec' => ($faker->biasedNumberBetween($min = 1, $max = 100)) / 100,
        'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => $user_id = rand(1, 4),
    ];
});
