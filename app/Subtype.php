<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Subtype extends Model
{
    use Searchable;

    public function profiles()
    {
        return $this->hasMany('App\Profile', 'type_id');
    }
}
