<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Tag extends Model
{
    use DatePresenter;
    	
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
