<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * This is the User model class for table "users".
 *
 * @property int id
 * @property varchar name
 * @property varchar email
 * @property varchar password
 * @property varchar remember_token
 * @property timestamp email_verified_at
 * @property timestamp  created_at
 * @property timestamp  updated_at
 */
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
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get random user.
     * @return User
     */
    public static function random():User
    {
        return self::inRandomOrder()->first();
    }

    /**
     * Get rules for validation.
     * @param  int  $id
     * @return array
     */
    public static function rules(int $id):array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email,'.$id,
            'password' => 'min:6|max:255'
        ];
    }
}
