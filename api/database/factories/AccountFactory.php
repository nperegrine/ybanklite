<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(App\Models\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'balance' => 5000,
        'currency' => 'usd',
        'user_id' => 1
    ];
});