<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Data\GrupoMaterial;

class GrupoMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        GrupoMaterial::truncate();

        foreach(range(1, 10) as $i) {
        	GrupoMaterial::create([
        		'zona_id'     => $i,
                'name'        => $faker->unique()->sentence(6, true),
        		'description' => $faker->paragraph(mt_rand(10, 20)),
        	]);
        }
    }
}
