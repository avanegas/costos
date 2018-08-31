<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Models\Data\GrupoObrero;
use Carbon\Carbon;

use App\Zona;
use App\User;


class Obrero extends Model
{
	protected $fillable = [
		'grupo_obrero_id', 'name', 'jornalhora', 'factor'
	];

	public function getCreatedAtAttribute($value)
	{
	  return Carbon::parse($value)->format('d/m/Y');
	}

	public function grupo_obrero()
	{
		return $this->belongsTo(GrupoObrero::class);
	}

	public function data_obrero()
	{
		return $this->hasOne(DataObrero::class);
	}

	public static function form()
	{
		return [
			'grupo_obrero_id'	=> '',
			'name'				=> '',
			'jornalhora'		=> '',
			'factor'			=> ''
		];
	}
}