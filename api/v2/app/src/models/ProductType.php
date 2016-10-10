<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	protected $table = "product_type";
    protected $fillable = ['type_name', 'unite'];

    public function type_products()
    {
        return $this->hasMany('App\Models\Product', 'ref_type', 'id');
    }
}

