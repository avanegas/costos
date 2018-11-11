<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Presenters\DatePresenter;

class Tag extends Model
{
    use DatePresenter, Sluggable;
    	
    protected $fillable = [
        'name'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

	public static function form()
	{
		return [
	    	'name' 	=> ''
	  	];
	}
}
