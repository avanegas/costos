<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Material;

use App\Zona;
use App\User;


class GrupoMaterial extends Model
{
	protected $fillable = [
		'zona_id', 'name', 'description'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class);
	}

	public function materials()
	{
		return $this->hasMany(Material::class);
	}

	public static function form()
	{
		return [
			'zona_id'		=> '',
			'name'			=> '',
			'description'	=> ''
		];
	}
}

