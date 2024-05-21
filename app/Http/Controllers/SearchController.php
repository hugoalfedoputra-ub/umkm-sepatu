<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        // Lakukan pencarian di model Product, misalnya mencari di kolom nama dan deskripsi
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->get();

        return view('search.results', compact('products', 'query'));
    }
}
