<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{
  protected $table = "client_wallet";
  protected $fillable = ['ref_cli', 'ref_type', 'amout', 'avout', 'date', 'qty'];
  public function product()
  {
      return $this->belongsTo('App\Models\ProductType', 'ref_type');
  }
  public function client()
  {
      return $this->belongsTo('App\Models\Client', 'ref_cli');
  }
  public function uph()
  {
      return $this->belongsTo('App\Models\Uph', 'ref_type');
  }
}
