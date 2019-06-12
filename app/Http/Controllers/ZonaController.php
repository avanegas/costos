<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zona;

class ZonaController extends Controller
{
    /**
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        $zonas = Zona::orderBy('updated_at', 'desc')->get();

        return response()
                ->json(['zonas' => $zonas]);
    }

    public function create()
    {
        $form = Zona::form();

        return response()
                ->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $zona = Zona::create($request->all());

        return response()
                ->json([
                    'saved'     => true,
                    'id'        => $zona->id,
                    'message'   => 'Ha ingresado correctamente la zona!'
                    ]);
    }

    public function edit($id)
    {
        $form = Zona::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        $zona = Zona::find($id);
        $zona->fill($request->all())->save();

        return response()
                ->json([
                    'saved'     => true,
                    'form'      => $zona,
                    'message'   => 'Ha actualizado correctamente la zona!'
                    ]);
    }

    public function destroy($id)
    {
        $zona = Zona::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
