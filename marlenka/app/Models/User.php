<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Cart;
use App\Notifications\EmailVerificationNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, HasRoles;


    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'postal_code', 'phone', 'country', 'provider_id', 'email_verified_at', 'verification_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function uploads(){
        return $this->hasMany(Upload::class);
    }

    public function userCoupon(){
        return $this->hasOne(UserCoupon::class);
    }
}
