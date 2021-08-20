<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SeasonsSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\UsersDatasSeeder;
use Database\Seeders\SexUserDataSeeder;
use Database\Seeders\DirectoresSeeder;
use Database\Seeders\ScoresSeeder;
use Database\Seeders\MoviesSeeder;
use Database\Seeders\FavoritesSeeder;
use Database\Seeders\SeriesSeeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){

        $this->call([

            SeasonsSeeder::class,
            DirectoresSeeder::class,
            SexUsersDatasSeeder::class, 
            UsersSeeder::class,
            UsersDatasSeeder::class,
            ScoresSeeder::class,
            MoviesSeeder::class,
            SeriesSeeder::class,
            FavoritesSeeder::class,
            

          ]);
        
    }
}
