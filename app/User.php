<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Presenters\DatePresenter;

use App\Models\Proyecto\ProyectoRubro;
use App\Models\Proyecto\Proyecto;
use App\Models\Precio\Precio;
use App\Models\Post\Post;
use App\Models\Post\Comment;

use App\Models\Oferta\Oferta;
use App\Zona;

class User extends Authenticatable
{
    use Notifiable, DatePresenter, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function precios()
    {
        return $this->hasMany(Precio::class);
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    public function zonas()
    {
        return $this->hasMany(Zona::class);
    }

    public static function form()
    {
      return [
        'name'      => '',
        'email'     => '',
        'password'  =>'',
        'roles'     =>[]
      ];
    }
}
