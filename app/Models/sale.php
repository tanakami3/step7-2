<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    //
    protected $table = 'sales';

    protected $fillable = 
    [
        'product_id',
    ];
}
