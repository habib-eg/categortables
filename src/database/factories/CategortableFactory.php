<?php

/** @var Factory $factory */

use App\Categortable;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(config('category.model_morph',Categortable::class), function (Faker $faker) {
    return [
        //
    ];
});
