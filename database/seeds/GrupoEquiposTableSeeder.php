<?php

use Illuminate\Database\Seeder;
use App\Models\Data\GrupoEquipo;

class GrupoEquiposTableSeeder extends Seeder
{
    public function run()
    {
        factory(GrupoEquipo::class,10)->create();
    }
}
