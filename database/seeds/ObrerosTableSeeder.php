<?php

use Illuminate\Database\Seeder;
use App\Models\Data\Obrero;

class ObrerosTableSeeder extends Seeder
{
    public function run()
    {
        factory(Obrero::class,10)->create();
    }
}
