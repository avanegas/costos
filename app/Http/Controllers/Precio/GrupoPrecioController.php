<?php

namespace App\Http\Controllers\Precio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoPrecioStoreRequest;
use App\Http\Requests\GrupoPrecioUpdateRequest;
use App\Models\Precio\GrupoPrecio;
use App\Zona;

class GrupoPrecioController extends Controller
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
        $grupo_precios = GrupoPrecio::with(['zona'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['grupo_precios' => $grupo_precios]);
    }

    public function create()
    {
        $form = GrupoPrecio::form();
        $zonas = Zona::orderBy('name', 'ASC')->get();

        return response()
                ->json([
                    'form' => $form,
                    'zonas' => $zonas
                ]);
    }

    public function store(GrupoPrecioStoreRequest $request)
    {
        $grupo_precio = GrupoPrecio::create($request->all());

        return response()
                ->json([
                    'saved'     => true,
                    'id'        => $grupo_precio->id,
                    'message'   => 'Ha ingresado correctamente el Grupo de precios!'
                    ]);
    }

    public function edit(Request $request, $id)
    {
        $form = GrupoPrecio::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(GrupoPrecioUpdateRequest $request, $id)
    {
        $grupo_precio = GrupoPrecio::find($id);
        $grupo_precio->fill($request->all())->save();

        return response()
                ->json([
                    'saved'     => true,
                    'form'      => $grupo_precio,
                    'message'   => 'Ha actualizado correctamente el Grupo de precios!'
                    ]);
    }

    public function destroy(Request $request, $id)
    {
        $grupo_precio = GrupoPrecio::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
