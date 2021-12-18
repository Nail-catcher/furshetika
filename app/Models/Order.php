<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =  ['name','address','phone','peoples', 'date','email','comm','payment','price'];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }
}
