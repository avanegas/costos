<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Category extends Model
{
    use DatePresenter;
    
    protected $fillable = [
        'name', 'slug', 'body'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

	public static function form()
	{
		return [
	    	'name' 	=> '',
	    	'slug' 	=> '',
	    	'body' 	=> ''
	  	];
	}
}
