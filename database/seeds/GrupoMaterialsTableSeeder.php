<?php

use Illuminate\Database\Seeder;
use App\Models\Data\GrupoMaterial;

class GrupoMaterialsTableSeeder extends Seeder
{
    public function run()
    {
        factory(GrupoMaterial::class,10)->create();
    }
}
