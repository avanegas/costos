<?php

use Illuminate\Database\Seeder;
use App\Models\Precio\GrupoPrecio;

class GrupoPreciosTableSeeder extends Seeder
{
    public function run()
    {
        factory(GrupoPrecio::class,10)->create();
    }
}
