<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    protected $fillable = ['id', 'value', 'product_id', 'attribute_id'];
}

