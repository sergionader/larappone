<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ProductVisit extends Model
{
    use Searchable;

    protected $table = 'product_visit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'visit_id'
    ];
}
