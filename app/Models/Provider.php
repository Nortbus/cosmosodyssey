<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'listid',
        'routeid',
        'providersid',
        'companyid',
        'company',
        'price',
        'flightstart',
        'flightend',
        'flighttime'
    ];

    
  
}
