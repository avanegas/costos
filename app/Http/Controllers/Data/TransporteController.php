<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransporteStoreRequest;
use App\Http\Requests\TransporteUpdateRequest;
use App\Models\Data\Transporte;
use App\Zona;

class TransporteController extends Controller
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
        $transportes = Transporte::with(['zona'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['transportes' => $transportes]);
    }

    public function create()
    {
        $form = Transporte::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store(TransporteStoreRequest $request)
    {
        $transporte = new Transporte($request->only('zona_id', 'name', 'unidad', 'tipo', 'tarifa'));
        $transporte->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $transporte->id,
                'message'   => 'Ha ingresado correctamente el transporte!'
            ]);
    }

    public function show($id)
    {
        $transporte = Transporte::with(['zona'])
            ->findOrFail($id);

        return response()
            ->json(['transporte' => $transporte]);
    }

    public function edit($id)
    {
        $form = Transporte::with(['zona'])
            ->findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(TransporteUpdateRequest $request, $id)
    {
        $transporte = Transporte::findOrFail($id)->update($request->all());

        return response()
            ->json([
                'saved'     => true,
                'form'      => $transporte,
                'message'   => 'Ha actualizado correctamente el transporte!'
            ]);
    }

    public function destroy($id)
    {
        $transporte = Transporte::findOrFail($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
