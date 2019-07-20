<?php

use Illuminate\Database\Seeder;
use App\Models\Oferta\Oferta;

class OfertasTableSeeder extends Seeder
{
    public function run()
    {
        factory(Oferta::class, 20)->create();
    }
}
