<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $fillable = [
        'qtd',
        'amount'
    ];

    public function visits()
    {
        return $this->belongsToMany(
            'App\Visit',
            'product_visit',
            'product_id',
            'visit_id'
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
