<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vents extends Model
{
  protected $table = 'basket';
  public function product()
  {
      return $this->belongsTo('App\Models\Product', 'ref_prod');
  }
  public function client()
  {
      return $this->belongsTo('App\Models\Client', 'ref_cli');
  }
  public function user()
  {
      return $this->belongsTo('App\Models\Users', 'ref_vend');
  }
}
