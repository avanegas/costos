<?php

namespace App\Models;

use App\User;
use App\Zona;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable = [
        'user_id', 'zona_id', 'country_id', 'prescision', 'iva1', 'iva2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function form()
    {
        return [
            'user_id'   => '',
            'zona_id'   => '',
            'country_id'=> '',
            'precision' => '',
            'iva1'      => '',
            'iva2'      => ''
        ];
    }
}
