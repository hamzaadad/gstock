<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uph extends Model
{
	protected $table = 'unite_price_history';
	public function uph(){
    	return $this->hasOne('App\Models\Prodcut', 'id');
    }
	
  // public function product()
  // {
  //     return $this->hasOne('App\Models\Stock', 'id', 'product_id');
  // }
}