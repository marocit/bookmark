<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
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
        'name', 'email', 'password', 'last_login', 'active', 'activation_token'
    ];

     protected $dates = [
        'created_at',
        'updated_at',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function isAdmin()
    // {
    //     if( $this->isAdmin == true ) {
    //         return true;
    //     }

    //     return false;
    // }

    public function avatar()
    {
        $email = $this->email;
        $default = 'wavatar';
        $size = 30;

        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

        return $grav_url;
    }

    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }


}
