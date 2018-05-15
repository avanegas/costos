<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Precio\GrupoPrecio;

class GrupoPreciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        GrupoPrecio::truncate();

        foreach(range(1, 10) as $i) {
        	GrupoPrecio::create([
        		'zona_id' => $i,
                'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        		'description' => $faker->paragraph(mt_rand(10, 20))
        	]);
        }
    }
}
