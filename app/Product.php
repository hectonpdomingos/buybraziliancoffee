<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name', 'type', 'product_code', 'ean', 'producer_id',
      'weight', 'photo', 'stock', 'cost', 'price', 'about_coffee'
    ];
}
