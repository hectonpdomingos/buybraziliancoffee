<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $fillable = [
    'owner', 'address', 'number', 'state', 'zipcode', 'email', 'phone',
    'phone2', 'cnpj', 'cpf', 'rs', 'nf', 'ie', 'im', 'about_producer'
  
    ];
}
