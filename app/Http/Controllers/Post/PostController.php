<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\CommentStoreRequest;

use App\Models\Post\Comment;
use App\Models\Post\Category;
use App\Models\Post\Post;
use App\Models\Post\Tag;

use File;

class PostController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        $posts = Post::with(['user','category'])->orderBy('created_at', 'DESC')->get();

        return response()
            ->json(['posts' => $posts]);
    }

    public function create()
    {
        $form = Post::form();
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return response()
            ->json([
                'form' => $form,
                'categories' => $categories,
                'tags' => $tags
                ]);
    }

    public function store(PostStoreRequest $request)
    {
        if(!$request->hasFile('file') && !$request->file('file')->isValid()) {
            return abort(404, 'Image not uploaded!');
        }

        $filename = $this->getFileName($request->file);
        $request->file->move(base_path('/public/images'), $filename);

        $tags = Arr::pluck($request->get('tags'),'id');

        $post = new Post($request->only('category_id', 'user_id', 'name', 'slug', 'excerpt', 'body', 'status'));
        $post->file = $filename;
        $post->save();

        //TAGS
        $post->tags()->attach($tags);

        return response()
            ->json([
                'saved'     => true,
                'id'        => $post->user_id,
                'message'   => 'Entrada creada con éxito!'
            ]);
    }

    private function getFileName($file)
    {
        return Str::random(32).'.'.$file->extension();
    }

    public function show($id)
    {
        $posts = Post::where('user_id', $id)->with(['user','category'])->orderBy('created_at', 'desc')->get();

        return response()
            ->json(['posts' => $posts]);
    }

    public function edit(Request $request, $id)
    {
        $form = Post::where('id', $id)->with(['comments', 'comments.user', 'user', 'category', 'tags'])->first();
        //$this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')->get();  //pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return response()
            ->json([
                'form'          => $form,
                'categories'    => $categories,
                'tags'          => $tags
                ]);

       // return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        //$this->authorize('pass', $post);

        $tags = Arr::pluck($request->get('tags'),'id');
        $post->fill($request->all())->save();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filename = $this->getFileName($request->file);
            $request->file->move(base_path('/public/images'), $filename);

            // remove old image
            File::delete(base_path('/public/images/'.$post->file));
            $post->file = $filename;
        }

        $post->save();

        //TAGS
        $post->tags()->sync($tags);

        return response()
            ->json([
                'saved'     => true,
                'id'        => $post->user_id,
                'message'   => 'Entrada actualizada con éxito!'
            ]);
    }

    public function destroy($id, Request $request)
    {
        $post = Post::find($id);
        //$this->authorize('pass', $post);

        // remove image
        File::delete(base_path('/public/images/'.$post->image));

        $post->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
