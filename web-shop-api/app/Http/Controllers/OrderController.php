<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function postItem(Request $request)
    {
        $params = $request->all();
        return OrderService::addItem($params['item_id']);
    }

    public function removeItem($itemId)
    {
        return OrderService::removeItem($itemId);
    }

    public function getOrder()
    {
        return OrderService::getActive();
    }

    public function pay()
    {
        return OrderService::pay();
    }

    public function orderHistory()
    {
        return OrderService::getHistory();
    }

}
