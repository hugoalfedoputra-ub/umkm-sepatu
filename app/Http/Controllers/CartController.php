<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product.variants'])->where('user_id', Auth::id())->first();

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'required|string',
            'size' => 'required|integer'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $product = Product::findOrFail($request->product_id);
        $productVariants = ProductVariant::findOrFail($request->product_id);

        if ($productVariants->stock < $request->quantity) {
            return response()->json(['message' => 'Stok produk tidak cukup'], 422);
        }

        $cartItem = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id],
            [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'selected' => true,
                'stock' => $productVariants->stock,
                'color' => $request->color,
                'size' => $request->size
            ]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }

    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        $cart = Cart::with('items')->where('user_id', Auth::id())->first();

        return response()->json(['success' => true]);
    }

    public function confirmChanges(Request $request)
    {
        $items = $request->input('items');
        $cart = Cart::with('items')->where('user_id', Auth::id())->first();

        if ($cart && !empty($items)) {
            foreach ($items as $itemId => $itemData) {
                $item = CartItem::find($itemId);
                if ($item) {
                    $item->quantity = $itemData['quantity'];
                    $item->selected = $itemData['selected'];
                    $item->save();
                }
            }

            // Redirect to the checkout index if the operation is successful
            return redirect()->route('checkout.index');
        }

        return response()->json(['success' => false]);
    }
}
