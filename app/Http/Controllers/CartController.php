<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $token = Cookie::get('cart_session_token');
        $cart = Cart::with('items')->where('session_token', $token)->first();

        $totalPrice = $cart->items->where('selected', true)->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cart', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $token = Cookie::get('cart_session_token');
        $cart = Cart::findOrCreateBySessionToken($token);

        $product = Product::findOrFail($request->product_id);

        $item = CartItem::updateOrCreate([
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
        ], [
            'name' => $product->name,
            'image' => $product->image,
            'quantity' => $request->quantity,
            'price' => $product->price,
        ]);

        return back()->with('success', 'Item ditambahkan ke keranjang!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'integer|min:1'
        ]);

        $item = CartItem::findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();

        return back();
    }

    public function updateSelected(Request $request, $id)
    {
        $request->validate([
            'selected' => 'boolean'
        ]);

        $item = CartItem::findOrFail($id);
        $item->selected = $request->selected ?? false;
        $item->save();

        return back()->with('success', 'berhasil!!!');
    }

    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return back();
    }
}
