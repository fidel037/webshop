<?php

namespace App\Http\Services;

use App\Item;

class ItemService
{
    public static function get()
    {
        return ResponseService::make(true, '', Item::paginate());
    }
}
