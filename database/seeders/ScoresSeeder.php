<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scores;
use Faker\Factory as Faker;

class ScoresSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $faker = Faker::create();

    	$type = new Scores();
        $type->users_id = 1;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();


    	$type = new Scores();
        $type->users_id = 2;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();

        $type = new Scores();
        $type->users_id = 4;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Scores();
        $type->users_id = 3;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Scores();
        $type->users_id = 1;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Scores();
        $type->users_id = 3;
        $type->puntuation = $faker->randomDigit();
        $type->description = $faker->text(30);
        $type->save();
    }
}
