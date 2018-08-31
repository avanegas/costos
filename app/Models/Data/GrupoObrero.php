<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Obrero;

use App\Zona;
use App\User;


class GrupoObrero extends Model
{
	protected $fillable = [
		'zona_id', 'name', 'description'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class);
	}

	public function obreros()
	{
		return $this->hasMany(Obrero::class);
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
