<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Presenters\DatePresenter;

use App\User;

class Post extends Model
{
    use DatePresenter, Sluggable;

    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug', 'excerpt', 'body', 'status', 'file'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public static function form()
    {
        return [
            'user_id'       => '',
            'category_id'   => '',
            'name'          => '',
            'slug'          => '',
            'excerpt'       => '',
            'body'          => '',
            'status'        => 'DRAFT',
            'file'          => '',
            'tags'          => [
            	PostTag::form()
            ]
        ];
    } 
}
