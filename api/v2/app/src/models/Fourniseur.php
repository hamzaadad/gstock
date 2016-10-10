<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fourniseur extends Model
{
  protected $fillable = ['nom', 'tell', 'address', 'city'];
  
}
