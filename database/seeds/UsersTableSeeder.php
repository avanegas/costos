<?php

use Illuminate\Database\Seeder;
use App\Repositories\User\EloquentUserRepository;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = User::create([
        	'name'      => 'Angel Vanegas',
        	'email'     => 'avanepe@hotmail.com',
        	'password'  => '$2y$10$4ZrcNsb3yeQ9DnYalzqLhOFV996gUQjUKrRW8nnutgN5/M.e4rsCC',   //alvape14
            'api_token' => str_random(60)
        ]);

        factory(User::class, 9)->create();

        $user->roles()->attach($role_admin);
    }
}
