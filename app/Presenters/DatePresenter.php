<?php
 
namespace App\Presenters;

use Carbon\Carbon;
use Jenssegers\Date\Date;

trait DatePresenter
{
  public function getCreatedAtAttribute($value)
  {
      Carbon::setLocale('es');
      return Carbon::parse($value)->format(' l, j\/m \d\e\l Y \a \l\a\s H:m');
  }

  public function getUpdatedAtAttribute($value)
  {
      Carbon::setLocale('es');
      return Carbon::parse($value)->toDateString();
  }
}