<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\GrupoMaterial;
use App\Zona;

class GrupoMaterialController extends Controller
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
        $grupo_materials = GrupoMaterial::with(['zona'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['grupo_materials' => $grupo_materials]);
    }

    public function create()
    {
        $form = GrupoMaterial::form();
        $zonas = Zona::orderBy('name', 'ASC')->get();

        return response()
                ->json([
                    'form' => $form,
                    'zonas' => $zonas
                ]);
    }

    public function store(Request $request)
    {
        $grupo_material = GrupoMaterial::create($request->all());

        return response()
                ->json([
                    'saved'     => true,
                    'id'        => $grupo_material->id,
                    'message'   => 'Ha ingresado correctamente el Grupo de materiales!'
                    ]);
    }

    public function edit(Request $request, $id)
    {
        $form = GrupoMaterial::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $grupo_material = GrupoMaterial::find($id);
        $grupo_material->fill($request->all())->save();

        return response()
                ->json([
                    'saved'     => true,
                    'form'      => $grupo_material,
                    'message'   => 'Ha actualizado correctamente el Grupo de materiales!'
                    ]);
    }

    public function destroy(Request $request, $id)
    {
        $grupo_material = GrupoMaterial::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
