<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\Data\Obrero;

use App\Zona;

class GrupoObrero extends Model
{
	use DatePresenter;

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
