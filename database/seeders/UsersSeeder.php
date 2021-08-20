<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Faker\Factory as Faker;


class UsersSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        $faker = Faker::create();
    
        $type = new Users();
        $type->email = 'comun@gmail.com';
        $type->password ='123';
        $type->save();
        
        $type = new Users();
        $type->email = $faker->unique()->safeEmail;
        $type->password ='$2y$10$in0EnAop5EWAXDwdBaewNeWS8QK3A4quUehRI9mCCYkXy6hJu0afm';
        $type->save();
        
        $type = new Users();
        $type->email = $faker->unique()->safeEmail;
        $type->password ='$2y$10$in0EnAop5EWAXDwdBaewNeWS8QK3A4quUehRI9mCCYkXy6hJu0afm';
        $type->save();

        $type = new Users();
        $type->email = $faker->unique()->safeEmail;
        $type->password ='$2y$10$in0EnAop5EWAXDwdBaewNeWS8QK3A4quUehRI9mCCYkXy6hJu0afm';
        $type->save();
  
    }
}
