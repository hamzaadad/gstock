<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
		protected $table = "product_type";
    protected $fillable = ['type_name', 'unite'];
		public function uph()
	  {
	      return $this->belongsTo('App\Models\Uph', 'ref_type');
	  }
}
