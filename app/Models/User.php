<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'telephone',
        'level',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
    public function bouquetCustom(){
        return $this->hasMany(BouquetCustom::class);
    }

    public function discount(){
        return $this->hasMany(Discount::class,'admin_id');
    }
}
