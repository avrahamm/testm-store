<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => "product-".$faker->randomNumber(5),
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(10,50),
        'image_url' => $faker->url,
    ];
});
