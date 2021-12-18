<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texted extends Model
{
    use HasFactory;
    protected $table='textes';
    public $timestamps = false;
}
