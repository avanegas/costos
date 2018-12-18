<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Data\Obrero;

class ObrerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Obrero::truncate();

  		foreach(range(1, 10) as $i) {
        	Obrero::create([
        		'grupo_obrero_id' => $i,
        		'name'        => $faker->unique()->name,
				'jornalhora'  => $faker->randomFloat(5, 1, 10),
        		'factor'      => $faker->randomFloat(5, 368, 420),
        	]);
        }
    }
}
