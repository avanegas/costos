<?php

use Illuminate\Database\Seeder;
use App\Repositories\User\EloquentUserRepository;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = User::create([
        	'name'      => 'Angel Vanegas',
        	'email'     => 'avanepe@hotmail.com',
        	'password'  => 'alvape14',
            'api_token' => Str::random(60)
        ]);

        factory(User::class, 9)->create();

        $user->roles()->attach($role_admin);
    }
}
