<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SexUsersDatas;

class SexUsersDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sex = new SexUsersDatas();
        $sex->name = 'Maculino';
        $sex->save();

        $sex = new SexUsersDatas();
        $sex->name = 'Femenino';
        $sex->save();
    }
}
