<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialStoreRequest;
use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Data\GrupoMaterial;
use App\Models\Data\Material;

class MaterialController extends Controller
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
        $materials = Material::with(['grupo_material'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['materials' => $materials]);
    }

    public function create()
    {
        $form = Material::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store(MaterialStoreRequest $request)
    {
        $material = new Material($request->only('grupo_material_id', 'name', 'unidad', 'precio'));
        $material->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $material->id,
                'message'   => 'Ha ingresado correctamente el material!'
            ]);
    }

    public function show($id)
    {
        $material = Material::with(['grupo_material'])
            ->findOrFail($id);

        return response()
            ->json(['material' => $material]);
    }

    public function edit($id)
    {
        $form = Material::with(['grupo_material'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(MaterialUpdateRequest $request, $id)
    {
        $material = Material::findOrFail($id)->update($request->all());

        return response()
            ->json([
                'saved'     => true,
                'form'      => $material,
                'message'   => 'Ha actualizado correctamente el material!'
            ]);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
