<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\Data\GrupoObrero;

class Obrero extends Model
{
	use DatePresenter;

	protected $fillable = [
		'grupo_obrero_id', 'name', 'jornalhora', 'factor'
	];

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
