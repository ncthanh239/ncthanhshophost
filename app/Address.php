<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   	protected $table='address';
   	protected $fillable=['id','user_id','address'];
}
