<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\AddressBook\Entities\Address;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Entities\PhoneNumber;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'user_id' => \factory(User::class),
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'photo' => 'avatars/test.jpg',
        'email' => $this->faker->unique()->email,
        'location' => $this->faker->city,
        'company' => $this->faker->company,
        'job_title' => $this->faker->jobTitle,
        'group_id' => null,
        'birth_date' => $this->faker->date(),
        'gender' => 'Male',
        'facebook_link' => $this->faker->url,
        'twitter_link' => $this->faker->url,
        'linkedin_link' => $this->faker->url,
        'instagram_link' => $this->faker->url,
        'addresses' => [\factory(Address::class)->make()->toArray()],
        'phones' => [\factory(PhoneNumber::class)->make()->toArray()]
    ];
});
