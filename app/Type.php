<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Searchable;

    public function profiles()
    {
        return $this->hasMany('App\Profile', 'subtype_id');
    }
}
