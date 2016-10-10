<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function fournisseur()
    {
        return $this->belongsTo('App\Models\Fourniseur', 'fourniseurs_id', 'id');
    }
}
