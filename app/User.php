<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','CPF','phone','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function findForPassport($username) {
        return $this->orWhere('CPF', $username)->orWhere('email',$username)->first();
    }

    public function role()
    {
      return $this->belongsTo('App\Role');
    }

    public function address()
    {
      return $this->belongsTo('App\Address');
    }

    public function client()
    {
      return $this->hasOne('App\Client','client_user');
    }

    public function clients()
    {
      return $this->hasMany('App\Client');
    }
}
