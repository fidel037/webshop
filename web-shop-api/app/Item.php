<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function order()
    {
        return $this->hasMany(Order::class,'item_id','id');
    }
}
