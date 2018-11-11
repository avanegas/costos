<?php

namespace App\Models\Precio;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\Precio\Equipo;

use App\Zona;
use App\User;

class GrupoPrecio extends Model
{
    use DatePresenter;
    	
	protected $fillable = [
		'zona_id', 'name', 'description'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class);
	}

	public function precios()
	{
		return $this->hasMany(Precio::class);
	}

	public static function form()
	{
		return [
			'zona_id' 		=> '',
			'name' 			=> '',
			'description' 	=> ''
		];
	}
}
