<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Data\Material;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Material::truncate();

  		foreach(range(1, 10) as $i) {
        	Material::create([
        		'grupo_material_id' => $i,
        		'name' => $faker->unique()->name,
        		'unidad' => $faker->word,
        		'precio' => $faker->randomFloat($nbMaxDecimals = 5, $min = 0, $max = 400)
        	]);
        }
    }
}
