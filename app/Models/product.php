<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = 
    [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

}