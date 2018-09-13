<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

use App\Zona;
use App\User;


class Transporte extends Model
{
    use DatePresenter;

	protected $fillable = [
		'zona_id', 'name', 'unidad', 'tipo', 'tarifa'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class);
	}

	public function data_transporte()
	{
		return $this->hasOne(DataTransporte::class);
	}

	public static function form()
	{
		return [
			'zona_id'	=> '',
			'name' 		=> '',
			'unidad' 	=> '',
			'tipo' 		=> '',
			'tarifa' 	=> ''
		];
	}
}