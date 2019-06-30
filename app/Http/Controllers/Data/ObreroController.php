<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ObreroStoreRequest;
use App\Http\Requests\ObreroUpdateRequest;
use App\Models\Data\GrupoObrero;
use App\Models\Data\Obrero;

class ObreroController extends Controller
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
        $obreros = Obrero::with(['grupo_obrero'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['obreros' => $obreros]);
    }

    public function create()
    {
        $form = Obrero::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store(ObreroStoreRequest $request)
    {
        $obrero = new Obrero($request->only('grupo_obrero_id', 'name', 'jornalhora', 'factor'));
        $obrero->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $obrero->id,
                'message'   => 'Ha ingresado correctamente el obrero!'
            ]);
    }

    public function show($id)
    {
        $obrero = Obrero::with(['grupo_obrero'])
            ->findOrFail($id);

        return response()
            ->json(['obrero' => $obrero]);
    }

    public function edit($id)
    {
        $form = Obrero::with(['grupo_obrero'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(ObreroUpdateRequest $request, $id)
    {
        $obrero = Obrero::findOrFail($id)->update($request->all());

        return response()
            ->json([
                'saved'     => true,
                'form'      => $obrero,
                'message'   => 'Ha actualizado correctamente el obrero!'
            ]);
    }

    public function destroy($id)
    {
        $obrero = Obrero::findOrFail($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
