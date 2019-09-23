<?php


namespace App\Http\Services;

use App\Item;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public static function addItem($itemId)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->item_id = (int) $itemId;
        return $order->save();
    }

    public static function removeItem($itemId)
    {
        $existingItem = Order::where('item_id', $itemId)->where('user_id', Auth::user()->id)->where('payed', 0)->first();
        return $existingItem->delete();
    }

    public static function getActive()
    {
        return Order::where('payed', 0)->where('user_id', Auth::user()->id)->with('item')->get()->pluck('item');
    }

    public static function getHistory()
    {
        return Order::where('payed', 1)->where('user_id', Auth::user()->id)->with('item')->get()->groupBy('orderNo');
    }

    public static function pay()
    {
        $orderId = uniqid().uniqid();
        return Order::where('payed', 0)->where('user_id', Auth::user()->id)->update(['payed' => 1, 'orderNo' => $orderId]);
    }
}
