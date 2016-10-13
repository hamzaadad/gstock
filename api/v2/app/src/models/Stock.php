<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function product_()
    {
        return $this->belongsTo('App\Models\Product');
        //->selectRaw('sum(rating) as rating, post_id')
        //->groupBy('post_id');
    }
    public function fournisseur()
    {
        return $this->belongsTo('App\Models\Fourniseur', 'fourniseurs_id', 'id');
    }
}
