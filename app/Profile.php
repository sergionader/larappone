<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Profile extends Model
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

    public function type()
    {
        return $this->belongsTo('App\Types');
    }

    public function subtype()
    {
        return $this->belongsTo('App\Subtypes');
    }
}
