<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use Searchable;
    protected $fillable = [
        'id',
        'name',
        'sort_order'
    ];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
