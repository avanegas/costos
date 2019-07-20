<?php

use Illuminate\Database\Seeder;
use App\Zona;

class ZonasTableSeeder extends Seeder
{
    public function run()
    {
        factory(Zona::class, 10)->create();
    }
}
