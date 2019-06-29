<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoEquipoStoreRequest;
use App\Http\Requests\GrupoEquipoUpdateRequest;
use App\Models\Data\GrupoEquipo;
use App\Zona;

class GrupoEquipoController extends Controller
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
        $grupo_equipos = GrupoEquipo::with(['zona'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['grupo_equipos' => $grupo_equipos]);
    }

    public function create()
    {
        $form = GrupoEquipo::form();
        $zonas = Zona::orderBy('name', 'ASC')->get();

        return response()
                ->json([
                    'form' => $form,
                    'zonas' => $zonas
                ]);
    }

    public function store(GrupoEquipoStoreRequest $request)
    {
        $grupo_equipo = GrupoEquipo::create($request->all());

        return response()
                ->json([
                    'saved'     => true,
                    'id'        => $grupo_equipo->id,
                    'message'   => 'Ha ingresado correctamente el Grupo de Equipos!'
                    ]);
    }

    public function edit(Request $request, $id)
    {
        $form = GrupoEquipo::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(GrupoEquipoUpdateRequest $request, $id)
    {
        $grupo_equipo = GrupoEquipo::find($id);
        $grupo_equipo->fill($request->all())->save();

        return response()
                ->json([
                    'saved'     => true,
                    'form'      => $grupo_equipo,
                    'message'   => 'Ha actualizado correctamente el Grupo de Equipos!'
                    ]);
    }

    public function destroy(Request $request, $id)
    {
        $grupo_equipo = GrupoEquipo::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
