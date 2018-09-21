<?php

namespace App\Model\Index;

use App\Model\RejectTeam;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'setting'=>'array'
    ];

    public function modifyPassword()
    {

    }

    function isTruePassword($origin_password)
    {

    }

    function team()
    {
        return $this->hasOne(Team::class);
    }

    function rejectTeam()
    {
        $this->hasMany(RejectTeam::class);
    }



}
