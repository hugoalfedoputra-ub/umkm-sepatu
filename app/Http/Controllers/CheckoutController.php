<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('selected', true)->get();

        if ($cartItems->isEmpty()) {
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

        $cartItems = CartItem::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('selected', true)->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors('Tidak ada item yang dipilih untuk dibeli.');
        }

        // Simpan pesanan ke database atau lakukan proses pembayaran di sini...

        // Hapus item yang dibeli dari keranjang
        foreach ($cartItems as $item) {
            $item->delete();
        }

        return redirect()->route('home')->with('success', 'Pesanan Anda telah berhasil diproses!');
    }
}
