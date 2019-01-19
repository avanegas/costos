<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    public function index(Request $request)
    {
        $users = User::with('roles')
                ->orderBy('id', 'ASC')->get();
        return response()
            ->json(['users' => $users]);
    }

    public function create()
    {
        $form = User::form();
        return response()
            ->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles[]']; //Retrieving the roles field

        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();            
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        return response()
            ->json([
                'saved' => true,
                'id' => $user->id,
                'message' => 'Ha ingresado correctamente un usuario!'
                ]);
        //return redirect()->route('users.index')->with('info', 'Usuario creado con éxito');
    }

    public function show($id)
    {
        return redirect('users');

        //$user = User::findOrFail($id);
        //return view('admin.users.show', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $form = User::where('id', $id)->with(['roles'])->first();
        //$form = User::findOrFail($id);
        $roles = Role::get();

        return response()
            ->json(['form' => $form, 'roles' => $roles]);

        //$user = User::findOrFail($id);
        //$roles = Role::get(); //Get all roles

        //return view('admin.users.edit', compact('user', 'roles')); //pass user and roles data to view
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ];

        if ($request->filled('password'))
        {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        $input = $request->only(['name', 'email', 'password']);
        $roles = $request->only(['role_id', 'model_type', 'model_id']);     //['roles'];
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
                'message' => 'Ha actualizado correctamente un usuario!'
            ]);

        //return redirect()->route('users.index')
        //    ->with('info', 'Usuario actualizado con éxito');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();

        return response()
            ->json(['deleted' => true]);

        //return back()->with('info', 'Eliminado correctamente');
    }
}
