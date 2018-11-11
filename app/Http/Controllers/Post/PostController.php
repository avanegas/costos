<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\CommentStoreRequest;

use Illuminate\Support\Facades\Storage;
use App\Models\Post\Comment;
use App\Models\Post\Category;
use App\Models\Post\Post;
use App\Models\Post\Tag;


use App\User;
use App\Auth;
use File;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

    public function __construct()
    {
        $this->middleware('auth');
    }    */
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user','category'])->orderBy('created_at', 'desc')->get();

        return response()
            ->json(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {

        //$post = Post::create($request->all());

        //IMAGE 
        //if($request->file('file')){
        //    $path = Storage::disk('public')->put('images',  $request->file('file'));
        //    $post->fill(['file' => asset($path)])->save();
        //}
        if(!$request->hasFile('file') && !$request->file('file')->isValid()) {
            return abort(404, 'Image not uploaded!');
        }

        $filename = $this->getFileName($request->file);
        $request->file->move(base_path('public/images'), $filename);

        $post = new Post($request->only('category_id', 'user_id', 'name', 'slug', 'excerpt', 'body', 'status'));
        $post->file = $filename;

        //$request->user()->posts()
        //    ->save($post);

        $post->save();

        //TAGS
        $post->tags()->attach($request->get('$tags'));
        

        return response()
            ->json([
                'saved'     => true,
                'id'        => $post->user_id,
                'message'   => 'You have successfully created post!'
            ]);
    }

    private function getFileName($file)
    {
        return str_random(32).'.'.$file->extension();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::where('user_id', $id)->with(['user','category'])->orderBy('created_at', 'desc')->get();

        return response()
            ->json(['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post       = Post::find($id);
        $this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $post->fill($request->all())->save();

        //IMAGE 
        if($request->file('file')){
            $path = Storage::disk('public')->put('image',  $request->file('file'));
            $post->fill(['file' => asset($path)])->save();
        }

        //TAGS
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Entrada actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $post->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}