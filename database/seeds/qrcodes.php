<?php

use Illuminate\Database\Seeder;
use App\Qrcode;
use Faker\Factory;
class qrcodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    for ($i = 1; $i < 20; $i++) {
       Qrcode::insert([
            'link_id' =>$i,
            'created_at'=>$faker->dateTimeBetween($startDate = '-7 days', $endDate = 'now', $timezone = null) 
            // 'created_at'=>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)
        ]);
    }
}
}
