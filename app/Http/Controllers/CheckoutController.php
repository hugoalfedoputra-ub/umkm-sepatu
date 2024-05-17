<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

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

        $cart = Cart::where('user_id', Auth::id())->first();

        $cartItems = $cart->items->where('selected', true);

        if (!$cart || $cartItems->isEmpty()) {
            return back()->withErrors('Tidak ada item yang dipilih untuk dibeli.');
        }

        // Simpan pesanan ke database atau lakukan proses pembayaran di sini...

        foreach ($cartItems as $item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Pesanan Anda telah berhasil diproses!');
    }
}
