<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $guarded = [];

    public function bouquet(){
        return $this->belongsTo(Bouquet::class);
    }
}
