<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movies;
use Faker\Factory as Faker;

class MoviesSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        $faker = Faker::create();

    	$type = new Movies();
        $type->scores_id = 2;
        $type->directores_id = 1;
        $type->name = $faker->name();
        $type->year = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->description = $faker->text(30);
        $type->save();

        $type = new Movies();
        $type->scores_id = 1;
        $type->directores_id = 3;
        $type->name = $faker->name();
        $type->year = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->description = $faker->text(30);
        $type->save();

        $type = new Movies();
        $type->scores_id = 3;
        $type->directores_id = 2;
        $type->name = $faker->name();
        $type->year = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->description = $faker->text(30);
        $type->save();

        $type = new Movies();
        $type->scores_id = 1;
        $type->directores_id = 1;
        $type->name = $faker->name();
        $type->year = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->description = $faker->text(30);
        $type->save();

        $type = new Movies();
        $type->scores_id = 1;
        $type->directores_id = 2;
        $type->name = $faker->name();
        $type->year = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->description = $faker->text(30);
        $type->save();
    }
}
