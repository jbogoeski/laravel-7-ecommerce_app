<?php

namespace App;

use App\Image;
use App\Order;
use App\Payment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'admin_since'
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function payments() {
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id');
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
