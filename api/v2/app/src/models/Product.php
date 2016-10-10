<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['name'];

	public function product_type()
    {
        return $this->hasOne('App\Models\ProductType', 'id', 'ref_type');
    }
    public function uph(){
    	return $this->hasOne('App\Models\Uph', 'ref_prod');
    }
  // public function product()
  // {
  //     return $this->hasOne('App\Models\Stock', 'id', 'product_id');
  // }
}