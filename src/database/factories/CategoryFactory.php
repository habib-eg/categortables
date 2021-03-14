<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Habib\Categortable\Models\Category;
use Illuminate\Database\Eloquent\Factory;

$factory->define(config('category.model',config('category.model', Category::class)), function (Faker $faker) {
    $query = Category::whereNull('category_id')->inRandomOrder();

    return [
        "name"=>$faker->unique()->name,
        "active"=>$faker->boolean,
        "description"=>$faker->sentence(),
        "image"=>$faker->image(public_path('uploads')),
        "category_id"=>($query->count() > 0)? $query->first()->id : null,
        "options"=>[],
    ];
});
