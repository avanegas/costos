<?php

namespace App\Http\Controllers\Oferta;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfertaStoreRequest;
use App\Http\Requests\OfertaUpdateRequest;
use App\Models\Oferta\Oferta;
use App\Http\Requests;

use File;

class OfertaController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        $ofertas = Oferta::with(['user'])->orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['ofertas' => $ofertas]);
    }

    public function create()
    {
        $form = Oferta::form();

        return response()
            ->json([
               'form' => $form
            ]);
    }

    public function store(OfertaStoreRequest $request)
    {
        if(!$request->hasFile('file') && !$request->file('file')->isValid()) {
            return abort(404, 'Image not uploaded!');
        }

        $filename = $this->getFileName($request->file);
        $request->file->move(base_path('/public/images'), $filename);

        $oferta = new Oferta($request->only( 'user_id', 'name', 'unidad', 'descripcion', 'stock', 'precio', 'status'));
        $oferta->file = $filename;
        $oferta->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $oferta->user_id,
                'message'   => 'Oferta creada con éxito!'
            ]);
    }

    private function getFileName($file)
    {
        return Str::random(32).'.'.$file->extension();
    }

    public function show($id)
    {
        $ofertas = Oferta::where('user_id', $id)->with(['user'])->orderBy('created_at', 'desc')->get();

        return response()
            ->json(['ofertas' => $ofertas]);
    }

    public function edit(Request $request, $id)
    {
        $form = Oferta::where('id', $id)->with(['user'])->first();
        //$this->authorize('pass', $post);

        return response()
            ->json([
                'form'          => $form
            ]);
    }

    public function update(OfertaUpdateRequest $request, $id)
    {
        $oferta = Oferta::find($id);
        //$this->authorize('pass', $post);

        $oferta->fill($request->all())->save();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filename = $this->getFileName($request->file);
            $request->file->move(base_path('/public/images'), $filename);

            // remove old image
            File::delete(base_path('/public/images/'.$oferta->file));
            $oferta->file = $filename;
        }

        $oferta->save();

        return response()
            ->json([
                'saved'     => true,
                'id'        => $oferta->user_id,
                'message'   => 'Oferta actualizada con éxito!'
            ]);
    }

    public function destroy($id, Request $request)
    {
        $oferta = Oferta::find($id);
        //$this->authorize('pass', $post);

        // remove image
        File::delete(base_path('/public/images/'.$oferta->image));

        $oferta->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
