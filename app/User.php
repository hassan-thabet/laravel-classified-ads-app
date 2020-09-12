<?php

namespace App;

use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'photo_url' ,
        'mobile', 'email_verified', 'mobile_verified', 'password' , 'created_at'
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

    public function getActive()
    {
        return $this -> mobile_verified == 1 ? 'Verified' : 'Unverified';

    }
    public function getDate()
    {
        $date = $this -> created_at;
        return $date->format('Y-m-d - h:i A' , strtotime($date));
    }


    public function products(){
        return $this -> hasMany(Product::class);
    }
    public function wishList(){
        return $this->hasOne(WishList::class);
    }
    public function city(){
        return $this->hasOne(City::class);
    }
    public function govarnorate(){
        return $this->hasOne(Govarnorate::class);
    }

}
