<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items')->where('user_id', Auth::id())->first();

        $totalPrice = $cart ? $cart->items->where('selected', true)->sum(function ($item) {
            return $item->price * $item->quantity;
        }) : 'miaw';

        $countSelect = $cart ? $cart->items->where('selected', true)->count() : 0;

        return view('cart.index', compact('cart', 'totalPrice', 'countSelect'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $product = Product::findOrFail($request->product_id);

        $cartItem = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id],
            [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'selected' => true
            ]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
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

        return back();
    }

    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return back();
    }
}
