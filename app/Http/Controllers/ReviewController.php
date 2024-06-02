<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // Pastikan Anda memiliki model Review
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string'
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->customer_name = Auth::user()->name; // Sesuaikan dengan field nama user Anda
        $review->comment = $request->comment;
        $review->rating = $request->rating; // Tambahkan input rating jika perlu
        $review->save();

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
