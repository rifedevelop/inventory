<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['item_id', 'type', 'qty', 'created_by'];

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
