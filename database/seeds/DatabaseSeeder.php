<?php

use App\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $country = new Country();
       $country->name = 'Lebanon';
       $country->save();
    }
}
