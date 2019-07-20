<?php

use Illuminate\Database\Seeder;
use App\Models\Data\GrupoObrero;

class GrupoObrerosTableSeeder extends Seeder
{
    public function run()
    {
        factory(GrupoObrero::class,10)->create();
    }
}
