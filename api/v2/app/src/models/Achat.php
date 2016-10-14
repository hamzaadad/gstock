<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    // protected $fillable = ['name'];

    public function product_type()
    {
        return $this->hasOne('App\Models\ProductType', 'id', 'ref_type');
    }
    public function fournisseur()
    {
        return $this->hasOne('App\Models\Fourniseur', 'id', 'ref_for');
    }
    
    public function uph(){
        return $this->hasOne('App\Models\Uph', 'id', 'ref_type');
    }

    public function stock(){
        return $this->hasOne('App\Models\Stock');
    }
}