<?php

namespace App\Http\Controllers\Precio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Data\GrupoEquipo;
use App\Models\Data\GrupoMaterial;
use App\Models\Data\GrupoObrero;
use App\Models\Data\Equipo;
use App\Models\Data\Material;
use App\Models\Data\Obrero;
use App\Models\Data\Transporte;

use App\Models\Precio\GrupoPrecio;
use App\Models\Precio\Precio;
use App\Models\Precio\PrecioEquipo;
use App\Models\Precio\PrecioMaterial;
use App\Models\Precio\PrecioObrero;
use App\Models\Precio\PrecioTransporte;

use App\User;

class PrecioController extends Controller
{
    public function search()
    {
        $results = Precio::orderBy('name')
                    ->when(request('q'), function($query) {
                        $query->where('name', 'like', '%'.request('q').'%')
                            ->orWhere('detalle', 'like', '%'.request('q').'%');
                    })
                    ->limit(6)
                    ->get();

        return response()
            ->json(['results' => $results]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precios = Precio::with(['grupo_precio'])->orderBy('name', 'ASC')->get();

        return response()
                ->json(['precios' => $precios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precio = Precio::with(['user','grupo_precio', 'equipos', 'obreros', 'materials', 'transportes'])
            ->findOrFail($id);

        return response()
            ->json([
                'precio' => $precio
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $form = Precio::with(['grupo_precio', 'equipos', 'obreros', 'materials', 'transportes'])
            ->findOrFail($id);
        $grupo_precios = GrupoPrecio::get();        
        
        return response()
            ->json([
                'form' => $form,
                'grupo_precios' => $grupo_precios
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
