<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\Data\GrupoEquipo;

use App\Zona;
use App\User;


class Equipo extends Model
{
    use DatePresenter;

	protected $fillable = [
		'grupo_equipo_id', 'name', 'marca', 'tipo', 'tarifa'
	];

	public function grupo_equipo()
	{
		return $this->belongsTo(GrupoEquipo::class);
	}

	public function data_equipo()
	{
		return $this->hasOne(DataEquipo::class);
	}

	public static function form()
	{
		return [
	    	'grupo_equipo_id' 	=> '',
	    	'name' 				=> '',
	    	'marca' 			=> '',
	    	'tipo' 				=> '',
	    	'tarifa' 			=> ''
	  	];
	}
}
