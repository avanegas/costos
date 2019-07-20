<?php

use Illuminate\Database\Seeder;
use App\Models\Data\Transporte;

class TransportesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Transporte::class,10)->create();
    }
}
