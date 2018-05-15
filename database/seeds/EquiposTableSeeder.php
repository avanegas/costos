<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Data\Equipo;

class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Equipo::truncate();

        foreach(range(1, 10) as $i) {
        	Equipo::create([
        		'grupo_equipo_id' => $i,
        		'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        		'marca' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        		'tipo' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        		'tarifa' => $faker->randomFloat($nbMaxDecimals = 5, $min = 0, $max = 400)
        	]);
        }
    }
}
