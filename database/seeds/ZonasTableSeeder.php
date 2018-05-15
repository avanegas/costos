<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Zona;

class ZonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Factory::create();

        Zona::truncate();

        foreach(range(1, 10) as $i) {
        	Zona::create([
        		'name' => $faker->name,
        		'description' => $faker->paragraph(mt_rand(10, 20)),
        		'user_id' => $i
        	]);
        }
    }
}
