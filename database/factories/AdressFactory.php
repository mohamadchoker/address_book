<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */



use Faker\Generator as Faker;
use Modules\AddressBook\Entities\Address;

$titles = ['work','home'];

$factory->define(Address::class, function (Faker $faker) use ($titles)  {
    return [
        'title' => $titles[$faker->numberBetween(0,count($titles)-1)],
        'line1' => $faker->address,
        'line2' => $faker->secondaryAddress,
        'state' => $faker->state,
        'city' => $faker->city,
        'street' => $faker->streetName,
        'zip' => $faker->postcode,
        'country' => 1

    ];
});
