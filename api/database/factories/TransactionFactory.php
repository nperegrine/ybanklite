<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(App\Models\Transaction::class, function (Faker $faker) {
    return [
        'from' => 1,
        'to' => 2,
        'details' => 'Sample transaction details',
        'amount' => 10000,
    ];
});