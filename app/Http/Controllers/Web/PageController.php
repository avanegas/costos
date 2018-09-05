<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post\Comment;
use App\Models\Post\Category;
use App\Models\Post\Post;
use App\Models\Post\Tag;

use App\Models\Data\GrupoEquipo;
use App\Models\Data\Equipo;

use App\Models\Data\GrupoMaterial;
use App\Models\Data\Material;

use App\Models\Data\GrupoObrero;
use App\Models\Data\Obrero;

use App\Models\Data\Transporte;

use App\Zona;
use App\User;


class PageController extends Controller
{
    
    public function blog()
    {
    	$posts = Post::where('status', 'PUBLISHED')->with(['user', 'category', 'comments'])->orderBy('created_at', 'desc')->get();
        
    	return response()
            ->json(['posts' => $posts
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->pluck('id')->first();
        
        $posts = Post::where('status', 'PUBLISHED')->where('category_id', $category)->with(['user', 'category', 'comments'])->orderBy('created_at', 'desc')->get();

        return response()
            ->json(['posts' => $posts
        ]);
    }

    public function tag($slug)
    {
        $posts = Post::whereHas('tags', function($query) use ($slug) {
                $query->where('slug', $slug);
            })->with(['user', 'category', 'comments'])->orderBy('created_at', 'desc')->where('status', 'PUBLISHED')->get();

        return response()
            ->json(['posts' => $posts
        ]);
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->with(['comments', 'comments.user', 'user', 'category', 'tags'])->first();
        
        return response()
            ->json(['post' => $post
        ]);
    }

    public function equipo()
    {
        $equipos = Equipo::with(['grupo_equipo'])->orderBy('name', 'ASC')->get();

        return response()
            ->json(['equipos' => $equipos
        ]);
    }

    public function material()
    {
        $materials = Material::with(['grupo_material'])->orderBy('name', 'ASC')->get();

        return response()
            ->json(['materials' => $materials
        ]);
    }

    public function obrero()
    {
        $obreros = Obrero::with(['grupo_obrero'])->orderBy('name', 'ASC')->get();

        return response()
            ->json(['obreros' => $obreros
        ]);
    }

    public function transporte()
    {
        $transportes = Transporte::with(['zona'])->orderBy('name', 'ASC')->get();

        return response()
            ->json(['transportes' => $transportes
        ]);
    }

}
