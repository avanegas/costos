<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Arr;
use App\User;
use Session;
use Auth;

class UserController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);   //middleware
    }
    */

    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'DESC')->get();

        return response()
            ->json(['users' => $users]);
    }

    public function create()
    {
        $form = User::form();
        $roles = Role::pluck('name', 'id');

        return response()
            ->json([
                'form' => $form,
                'roles' => $roles
                ]);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles']; //Retrieving the roles field

        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);     //Assigning role to user
            }
        }
        return response()
            ->json([
                'saved'     => true,
                'id'        => $user->id,
                'message'   => 'Ha ingresado correctamente un usuario!'
                ]);
    }

    public function show($id)
    {
        return redirect('users');

        //$user = User::findOrFail($id);
        //return view('admin.users.show', compact('user'));
    }

    public function edit( $id)
    {
        $form = User::with(['roles'])->findOrFail($id);

        $roles = Role::pluck('name', 'id');

        return response()
            ->json([
                'form' => $form,
                'roles' => $roles
                ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  =>'required',
            'email' =>'required|email|unique:users,email,'.$id,
            'roles' => 'required|array'

        ]);

        $user = User::findOrfail($id);

        $input = $request->only(['name', 'email', 'password']);
        $roles = Arr::pluck($request->get('roles'),'id');
        //$roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }

        $user->fill($request->all())->save();

        return response()
            ->json([
                'saved'   => true,
                'id'      => $user->id,
                'message' => 'Usuario actualizado con éxito!'
            ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
