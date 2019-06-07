<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Post\Tag;

class TagController extends Controller
{
    /**
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    public function index()
    {
        $tags = Tag::orderBy('updated_at', 'desc')->get();

        return response()
            ->json(['tags' => $tags]);
    }

    public function create()
    {
        $form = Tag::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->all());

        return response()
            ->json([
                'saved' => true,
                'id' => $tag->id,
                'message' => 'Ha ingresado correctamente la etiqueta de caracterización especifica!'
                ]);
    }

    public function edit(Request $request, $id)
    {
        $form = Tag::findOrFail($id);

        return response()
            ->json(['form' => $form]);
    }

    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->fill($request->all())->save();

        return response()
            ->json([
                'saved' => true,
                'form' => $tag,
                'message' => 'Ha actualizado correctamente la etiqueta de caracterización especifica!'
                ]);
    }

    public function destroy(Request $request, $id)
    {
        $tag = Tag::find($id)->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
