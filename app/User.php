<?php

namespace App;

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

    protected $table = 'empolyee'; // ใส่ชื่อตาราง
    protected $primaryKey = 'emp_id'; // ใส่ Primary Key

    // protected $fillable = [
    //     'username', 'password', 'user_type'
    // ];

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
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // User Type ****

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 2;
    
    public function isAdmin()
    {
        return $this->position_id === self::ADMIN_TYPE;
    }
    
}
