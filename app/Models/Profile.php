<?php

namespace App\Models;

use App\User;
use App\Zona;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'tipo', 'bio', 'phone', 'twitter_username', 'github_username', 'location', 'avatar', 'avatar_status', 'status', 'activated'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function form()
    {
        return [
            'user_id'           => '',
            'tipo'              => '',
            'bio'               => '',
            'phone'             => '',
            'twitter_username'  => '',
            'github_username'   => '',
            'location'          => '',
            'avatar'            => '',
            'avatar_status'     => '',
            'status'            => '',
            'activated'         => ''
        ];
    }
}
