<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;
use App\Models\Data\Equipo;

use App\Zona;

class GrupoEquipo extends Model
{
    use DatePresenter;
    	
	protected $fillable = [
		'zona_id', 'name', 'description'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class);
	}

	public function equipos()
	{
		return $this->hasMany(Equipo::class);
	}

	public static function form()
	{
		return [
			'zona_id'		=> '',
	    	'name' 			=> '',
			'description' 	=> ''
		];
	}
}
