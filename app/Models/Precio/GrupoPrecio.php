<?php

namespace App\Models\Precio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Precio\Precio;

use App\User;
use App\Zona;

class GrupoPrecio extends Model
{
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
