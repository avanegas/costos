<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EquipoStoreRequest;
use App\Http\Requests\EquipoUpdateRequest;
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

    public function store(EquipoStoreRequest $request)
    {
        $equipo = new Equipo($request->only('grupo_equipo_id', 'name', 'marca', 'tipo', 'tarifa'));
        $equipo->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $equipo->id,
                'message'   => 'Ha ingresado correctamente el equipo!'
                ]);
    }

    public function show($id)
    {
        $equipo = Equipo::with(['grupo_equipo'])
            ->findOrFail($id);

        return response()
            ->json(['equipo' => $equipo]);
    }

    public function edit($id)
    {
        $form = Equipo::with(['grupo_equipo'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(EquipoUpdateRequest $request, $id)
    {
        $equipo = Equipo::findOrFail($id)->update($request->all());

        return response()
            ->json([
                'saved'     => true,
                'form'      => $equipo,
                'message'   => 'Ha actualizado correctamente un equipo!'
                ]);
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
