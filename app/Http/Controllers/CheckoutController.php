<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        $cartItems = $cart->items->where('selected', true);

        if (!$cart || $cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item yang dipilih untuk checkout.');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);

        $userId = Auth::id();

        $cartItems = CartItem::with('product.variants')->whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('selected', true)->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors('Tidak ada item yang dipilih untuk dibeli.');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'total_price' => $totalPrice,
            'address' => $request->address
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'name' => $cartItem->name,
                'image' => $cartItem->image,
                'price' => $cartItem->price,
                'size' => $cartItem->size,
                'color' => $cartItem->color,
                'quantity' => $cartItem->quantity
            ]);

            $variant = $cartItem->product->variants->first(function ($variant) use ($cartItem) {
                return $variant->size == $cartItem->size && $variant->color == $cartItem->color;
            });

            // if ($variant) {
            $variant->stock -= $cartItem->quantity;
            $variant->save();
            // } else {
            // Handle the case where the variant is not found, if necessary
            // }


            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Pesanan Anda telah berhasil diproses!');
    }
}
