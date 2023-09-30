<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bouquet(){
        return $this->belongsTo(Bouquet::class);
    }
    public function bouquetCustom(){
        return $this->belongsTo(BouquetCustom::class);
    }
}
