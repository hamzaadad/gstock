<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{
  protected $table = "client_wallet";
  protected $fillable = ['ref_cli', 'amout', 'avout'];
    function getUser(){}
}
