<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Series;
use App\Models\Seasons;
use Faker\Factory as Faker;

class SeasonsSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
           
        $faker = Faker::create();

    	$type = new Seasons();
        $type->cap = $faker->randomDigit();
        $type->seasons_number = $faker->randomDigit();
        $type->save();
        
        $type = new Seasons();
        $type->cap = $faker->randomDigit();
        $type->seasons_number = $faker->randomDigit();
        $type->save();

        $type = new Seasons();
        $type->cap = $faker->randomDigit();
        $type->seasons_number = $faker->randomDigit();
        $type->save();

        $type = new Seasons();
        $type->cap = $faker->randomDigit();
        $type->seasons_number = $faker->randomDigit();
        $type->save();

        $type = new Seasons();
        $type->cap = $faker->randomDigit();
        $type->seasons_number = $faker->randomDigit();
        $type->save();
    }
}
