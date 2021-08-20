<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\UsersDatas;
use App\Models\Users;
use App\Models\SexUsersDatas;
use Faker\Factory as Faker;

class UsersDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        $faker = Faker::create();

    	$type = new UsersDatas();
        $type->users_id = 1;
        $type->sex_users_datas_id = 1;
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->save();


    	$type = new UsersDatas();
        $type->users_id = 2;
        $type->sex_users_datas_id = 2;
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->save();


    	$type = new UsersDatas();
        $type->users_id = 3;
        $type->sex_users_datas_id = 1;
        $type->name = $faker->name();
        $type->lastname = $faker->lastName();
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->save();

    }
}
