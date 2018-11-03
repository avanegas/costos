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

use App\Zona;

class User extends Authenticatable
{
    use Notifiable, DatePresenter, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
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
