<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $fillable = [
    	'post_id', 'tag_id'];

    public $timestamp = false;

    public Static function form()
    {
    	return [
    		'post_id' => '',
    		'tag_id'  => ''
    	];
    }

}
