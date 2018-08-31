<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Zona;
use App\User;


class Transporte extends Model
{
	protected $fillable = [
		'zona_id', 'name', 'unidad', 'tipo', 'tarifa'
	];
	
	public function getCreatedAtAttribute($value)
	{
	  return Carbon::parse($value)->format('d/m/Y');
	}

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