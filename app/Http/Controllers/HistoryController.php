<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($id)
    {
        $myOrders = Order::select('orders.id as nomor_id', 'orders.user_id as user_id', 'orders.created_at as waktu_order', 'orders.status as status', 'orders.address as address', 'order_items.quantity as kuantitas', 'order_items.price as harga', 'order_items.name as nama_produk', 'order_items.color as color')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $id)
            ->paginate(12);
        return view('history.index', compact('myOrders'));
    }
}
