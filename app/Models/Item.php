<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'code',
        'category',
        'item_name',
        'stock',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    protected $table = 'items';

    public $timestamps = false;
}
