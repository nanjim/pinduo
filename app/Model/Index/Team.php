<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    function user()
    {
        return $this->belongsTo(User::class);
    }

}
