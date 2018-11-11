<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\GrupoObrero;
use App\Zona;

class GrupoObreroController extends Controller
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
        $grupo_obreros = GrupoObrero::with(['zona'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['grupo_obreros' => $grupo_obreros]);
    }

    public function create()
    {
        $form = GrupoObrero::form();
        $zonas = Zona::orderBy('name', 'ASC')->get();

        return response()
                ->json([
                    'form' => $form,
                    'zonas' => $zonas
                ]);
    }

    public function store(Request $request)
    {
        $grupo_obrero = GrupoObrero::create($request->all());

        return response()
                ->json([
                    'saved'     => true,
                    'id'        => $grupo_obrero->id,
                    'message'   => 'Ha ingresado correctamente el Grupo de obreros!'
                    ]);
    }

    public function edit(Request $request, $id)
    {
        $form = GrupoObrero::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $grupo_obrero = GrupoObrero::find($id);
        $grupo_obrero->fill($request->all())->save();

        return response()
                ->json([
                    'saved'     => true,
                    'form'      => $grupo_obrero,
                    'message'   => 'Ha actualizado correctamente el Grupo de obreros!'
                    ]);
    }

    public function destroy(Request $request, $id)
    {
        $grupo_obrero = GrupoObrero::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
