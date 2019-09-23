<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemService;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function postSearch(Request $request)
    {
        return ItemService::get();
    }
}
