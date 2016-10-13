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
    public function fournisseur()
    {
        return $this->hasOne('App\Models\Fourniseur', 'id', 'ref_four');
    }
    
    public function uph(){
    	return $this->hasOne('App\Models\Uph');
    }

    public function stock(){
        return $this->hasOne('App\Models\Stock');
    }
}
