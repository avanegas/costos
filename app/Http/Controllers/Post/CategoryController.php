<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Post\Category;

class CategoryController extends Controller
{
    /**
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    public function index()
    {
        $categories = Category::orderBy('updated_at', 'desc')->get();

        return response()
                ->json(['categories' => $categories]);
    }

    public function create()
    {
        $form = Category::form();

        return response()
                ->json(['form' => $form]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());

        return response()
	            ->json([
	                'saved' 	=> true,
	                'id' 		=> $category->id,
	                'message' 	=> 'Ha ingresado correctamente la categoría para artículos!'
	                ]);
    }

    public function edit(Request $request, $id)
    {
        $form = Category::findOrFail($id);

        return response()
                ->json(['form' => $form]);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->all())->save();

        return response()
	            ->json([
	                'saved' 	=> true,
	                'form' 		=> $category,
	                'message' 	=> 'Ha actualizado correctamente la categoría!'
	                ]);
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::find($id)->delete();
        
        return response()
                ->json(['deleted' => true]);
    }
}
