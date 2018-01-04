<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use Searchable;
    protected $fillable = [
        'id',
        'name',
        'company',
        'email',
        'phone',
        'message'
    ];
}
