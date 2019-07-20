<?php

use Illuminate\Database\Seeder;
use App\Models\Data\Equipo;

class EquiposTableSeeder extends Seeder
{
    public function run()
    {
        factory(Equipo::class, 10)->create();
    }
}
