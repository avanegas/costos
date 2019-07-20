<?php

use Illuminate\Database\Seeder;
use App\Models\Data\Material;

class MaterialsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Material::class,10)->create();
    }
}
