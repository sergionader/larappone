<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Visit extends Model
{
    use Searchable;

    protected $fillable = [
        'unit',
        'name',
        'dt',
        'dt_unix',
        'month_year',
        'tm',
        'tm_unix',
        'profile_id',
        'origin_id',
        'avg',
        'max',
        'min',
        'prec',
        'comment',
        'user_id'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['products'] = $this->products->toArray();
        $array['origin'] = $this->origin->toArray();
        $array['profile'] = $this->profile->toArray();
        $array['user'] = $this->user->toArray();
        return $array;
    }

    public function origin()
    {
        return $this->belongsTo('App\Origin');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany(
            'App\Product',
            'product_visit'
            )
                ->withPivot(
                    'product_id',
                    'visit_id',
                    'qtd',
                    'amount'
                )
                    ->withTimeStamps();
    }
}
