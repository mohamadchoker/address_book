<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */



use Faker\Generator as Faker;
use Modules\AddressBook\Entities\PhoneNumber;

$phone_types = ['mobile','home','fax'];

$factory->define(PhoneNumber::class, function (Faker $faker) use ($phone_types) {
    return [
        'number' =>  $faker->e164PhoneNumber,
        'type' => $phone_types[$faker->numberBetween(0,count($phone_types)-1)],
    ];
});
