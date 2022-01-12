<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AltOrder extends Model
{
    use HasFactory;
    protected $fillable=[
    'name',
           'address',
           'phone',
            'event',
           'peoples',
            'date',
            'email',
            'menu',
            'comm'

    ];
}
