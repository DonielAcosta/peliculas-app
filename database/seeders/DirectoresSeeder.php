<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Directores;
use Faker\Factory as Faker;

class DirectoresSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
         
        $faker = Faker::create();

    	$type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();


    	$type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();

        $type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();


        $type = new Directores();
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->description = $faker->text(30);
        $type->save();


    }
}
