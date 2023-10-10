<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'listid',
        'routeid',
        'routeid2',
        'fromid',
        'from',
        'toid',
        'to',
        'distance',
    ];

    
}
