<?php


namespace App\Http\Services;


use App\Item;

class ItemService
{
    public static function get()
    {
        return Item::paginate();
    }
}
