<?php

namespace App\Model;

use App\Model\Index\User;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    function cat()
    {
        return $this->belongsTo(Cats::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
