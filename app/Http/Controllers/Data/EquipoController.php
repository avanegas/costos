<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Data\GrupoEquipo;
use App\Models\Data\Equipo;

class EquipoController extends Controller
{
/**
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except(['index', 'show']);
    }
*/

    public function index()
    {
        $equipos = Equipo::with(['grupo_equipo'])->orderBy('name', 'asc')->get();

        return response()
            ->json(['equipos' => $equipos]);
    }

    public function create()
    {
        $form = Equipo::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_equipo_id'   => 'required',
            'name'              => 'required|max:60',
            'marca'             => 'nullable|max:60',
            'tipo'              => 'nullable|max:60',
            'tarifa'            => 'required|numeric'
            ]);

        $equipo = new Equipo($request->only('grupo_equipo_id', 'name', 'marca', 'tipo', 'tarifa'));

        $equipo->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $equipo->id,
                'message'   => 'Ha ingresado correctamente un equipo!'
                ]);
    }

    public function show($id)
    {
        $equipo = Equipo::with(['grupo_equipo'])
            ->findOrFail($id);

        return response()
            ->json(['equipo' => $equipo]);
    }

    public function edit(Request $request, $id)
    {
        $form = Equipo::with(['grupo_equipo'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo_equipo_id'   => 'required',
            'name'              => 'required|max:60',
            'marca'             => 'nullable|max:60',
            'tipo'              => 'nullable|max:60',
            'tarifa'            => 'required|numeric'
        ]);

        $equipo = Equipo::findOrFail($id)->update($request->all());

        return response()
            ->json([
                'saved'     => true,
                'form'      => $equipo,
                'message'   => 'Ha actualizado correctamente un equipo!'
                ]);
    }

    public function destroy(Request $request, $id)
    {
        $equipo=Equipo::findOrFail($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
