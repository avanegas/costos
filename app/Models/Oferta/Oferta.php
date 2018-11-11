<?php

namespace App\Models\Oferta;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

use App\User;

class Oferta extends Model
{
    use DatePresenter;

    protected $fillable = [
        'user_id', 'name', 'unidad', 'descripcion', 'stock', 'precio', 'file', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
