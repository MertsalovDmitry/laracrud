<?php

namespace App;

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

    /**
    * Get the employees created by this user
    */
    public function createdEmployees(){
        return $this->hasMany(Employee::class);
    }

    /**
    * Get the employees updates by this user
    */
    public function updatedEmployees(){
        return $this->hasMany(Employee::class);
    }

    /**
    * Get the positions created by this user
    */
    public function createdPositions(){
        return $this->hasMany(Position::class);
    }

    /**
    * Get the positions updates by this user
    */
    public function updatedPositions(){
        return $this->hasMany(Position::class);
    }
}
