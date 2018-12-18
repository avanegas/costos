<?php

use Illuminate\Database\Seeder;

class OfertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Oferta\Oferta::class, 20)->create();
    }
}
