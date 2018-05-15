<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Models\Data\GrupoMaterial;

use App\User;
use App\Zona;

class Material extends Model
{
	protected $fillable = [
		'grupo_material_id', 'name', 'unidad', 'precio'
	];

	public function grupo_material()
	{
		return $this->belongsTo(GrupoMaterial::class);
	}

	public function data_material()
	{
		return $this->hasOne(DataMaterial::class);
	}

	public static function form()
	{
		return [
			'grupo_material_id'	=> '',
			'name'				=> '',
			'unidad'			=> '',
			'precio'			=> ''
		];
	}
}
