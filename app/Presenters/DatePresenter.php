<?php
 
namespace App\Presenters;

use Carbon\Carbon;

trait DatePresenter
{
  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->format('m/d/Y H:i');
  }

  public function getUpdatedAtAttribute($value)
  {
      Carbon::setLocale('es');
      return Carbon::parse($value)->toDateString();
  }
}