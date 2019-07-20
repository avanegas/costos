<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Precio\Precio;
use App\Models\Precio\PrecioEquipo;
use App\Models\Precio\PrecioMaterial;
use App\Models\Precio\PrecioObrero;
use App\Models\Precio\PrecioTransporte;

class PreciosTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        //Precio::truncate();
        //PrecioEquipo::truncate();
        //PrecioMaterial::truncate();
        //PrecioObrero::truncate();
        //PrecioTransporte::truncate();

        foreach(range(1, 10) as $i) {
            Precio::create([
                'user_id'         => $i,
                'grupo_precio_id' => $i,
                'name'            => $faker->sentence,
                'unidad'          => $faker->word,
                'detalle'         => $faker->paragraph(mt_rand(1, 2)),
                'directo'         => $faker->randomFloat(5, 1.20, 120),
                'indirecto'       => 18,
            ]);
            foreach(range(1, mt_rand(3, 5)) as $j) {
                PrecioEquipo::create([
                    'precio_id'  => $i,
                    'equipo_id'  => mt_rand(1, 10),
                    'name'       => $faker->sentence,
                    'tarifa'     => 1.20,
                    'cantidad'   => 2.42,
                    'rendimiento'=> 1.28,
                    'total'      => 6.42
                ]);
            }
            foreach(range(1, mt_rand(3, 5)) as $k) {
                PrecioMaterial::create([
                    'precio_id'  => $i,
                    'material_id'=> mt_rand(1, 10),
                    'name'       => $faker->sentence,
                    'unidad'     => $faker->word,
                    'precio'     => 2.1,
                    'cantidad'   => 2.5,
                    'total'      => 5.24
                ]);
            }
            foreach(range(1, mt_rand(3, 5)) as $l) {
                PrecioObrero::create([
                    'precio_id'  => $i,
                    'obrero_id'  => mt_rand(1, 10),
                    'name'       => $faker->sentence,
                    'jornalhora' => 2.15,
                    'cantidad'   => 1.20,
                    'rendimiento'=> 2.05,
                    'total'      => 6.42
                ]);
            }
            foreach(range(1, mt_rand(3, 5)) as $m) {
                PrecioTransporte::create([
                    'precio_id'     => $i,
                    'transporte_id' =>mt_rand(1, 10),
                    'name'          => $faker->sentence,
                    'unidad'        => $faker->word,
                    'tarifa'        => 2.64,
                    'cantidad'      => 2.4,
                    'distancia'     => 2.20,
                    'total'         => 6.42,
                ]);
            }
        }
    }
}
