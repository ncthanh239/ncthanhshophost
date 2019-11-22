<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['code', 'status', 'user_id', 'address', 'name', 'email', 'mobile', 'uaddress', 'total'];
}
