<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public static function rules ($id=0, $merge=[]) {
        return array_merge(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email'. ($id ? ",$id" : ''),
                'password' => 'required',
                'image' => 'image:jpeg,png,jpg,gif,svg|max:2048',
            ], 
            $merge);
    }

    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'email', 'password','token','age','image','description'];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
