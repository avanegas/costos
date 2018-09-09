<?php
 
namespace App\Presenters;

use Carbon\Carbon;

trait DatePresenter
{
  public function getCreatedAtAttribute($value)
  {
      return Carbon::parse($value)->formatLocalized('%A %d %B %Y');
  }

  public function getUpdatedAtAttribute($value)
  {
      return Carbon::parse($value)->toDateString();
  }
}