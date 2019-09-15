<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Arr;
use App\User;
use Session;
use Auth;

class RoleController extends Controller {
    /*
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);     //middleware
    }

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
         }
*/
public function index()
    {
        $roles = Role::with('permissions')->orderBy('name', 'ASC')->get();

        return response()
            ->json(['roles' => $roles]);
    }

    public function create()
    {
        $form = Role::form();
        $permissions = Permission::pluck('name', 'id');

        return response()
        ->json([
            'form' => $form,
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        return response()
            ->json([
                'saved'   => true,
                'id'      => $role->id,
                'message' => 'Ha ingresado correctamente un rol!'
                ]);
    }

    public function show($id)
    {
        return redirect('roles');
    }

    public function edit($id)
    {
        $form = Role::with(['permission'])->findOrFail($id);
        $permissions = Permission::get();

        return response()
            ->json([
                'form' => $form,
                'permissions' => $permissions
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $role = Role::findOrFail($id);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        return response()
            ->json([
                'saved'   => true,
                'id'      => $role->id,
                'message' => 'Rol actualizado con éxito!'
            ]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
