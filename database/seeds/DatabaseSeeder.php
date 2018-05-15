<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(ZonasTableSeeder::class);
        $this->call(GrupoEquiposTableSeeder::class);
        $this->call(GrupoMaterialsTableSeeder::class);
        $this->call(GrupoObrerosTableSeeder::class);
        $this->call(EquiposTableSeeder::class); 
        $this->call(MaterialsTableSeeder::class);
        $this->call(ObrerosTableSeeder::class);
        $this->call(TransportesTableSeeder::class);
        $this->call(GrupoPreciosTableSeeder::class);        
        $this->call(PreciosTableSeeder::class);
        $this->call(ProyectosTableSeeder::class);
    }
}
