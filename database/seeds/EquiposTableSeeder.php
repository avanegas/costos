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
        		'name'            => $faker->unique()->sentence(2, true),
        		'marca'           => $faker->sentence(3, true),
        		'tipo'            => $faker->sentence(2, true),
        		'tarifa'          => $faker->randomFloat(5, 0.1, 100),
        	]);
        }
    }
}
