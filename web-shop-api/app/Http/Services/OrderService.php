<?php

namespace App\Http\Services;

use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public static function addItem($itemId)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->item_id = (int) $itemId;
        if ($order->save()) {
            return ResponseService::make(true, 'Item added');
        }
        abort(500, 'addItem error');
    }

    public static function removeItem($itemId)
    {
        $existingItem = Order::where('item_id', $itemId)->where('user_id', Auth::user()->id)->where('payed', 0)->first();
        if ($existingItem->delete()) {
            return ResponseService::make(true, 'Item removed');
        }
        abort(500, 'removeItem error');
    }

    public static function getActive()
    {
        return ResponseService::make(true, '', Order::where('payed', 0)->where('user_id', Auth::user()->id)->with('item')->get()->pluck('item'));
    }

    public static function getHistory()
    {
        return ResponseService::make(true, '', Order::where('payed', 1)->where('user_id', Auth::user()->id)->with('item')->get()->groupBy('orderNo'));
    }

    public static function pay()
    {
        $orderId = uniqid() . uniqid();
        $order = Order::where('payed', 0)->where('user_id', Auth::user()->id);
        if ($order->update(['payed' => 1, 'orderNo' => $orderId])) {
            return ResponseService::make(true, 'Order ' . $orderId . ' payed!');
        }
        abort(500, 'item pay error');
    }
}
