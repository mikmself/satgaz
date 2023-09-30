<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $guarded = [];

    public function order(){
        return $this->hasMany(Order::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
