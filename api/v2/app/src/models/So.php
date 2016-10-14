<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class So extends Model
{
  protected $table = "stock_operations";
  protected $fillable = ['ref_type', 'qty'];
}
