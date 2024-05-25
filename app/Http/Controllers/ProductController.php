<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // get color and size
        $sizes = ProductVariant::select('size')->distinct()->get();
        $colors = ProductVariant::select('color')->distinct()->get();

        $query = Product::with('reviews', 'variants');

        // Filter
        if ($request->filled('color')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('color', $request->color);
            });
        }

        if ($request->filled('size')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size', $request->size);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rating_desc':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                    break;
                case 'rating_asc':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'comments_desc':
                    $query->withCount('reviews')->orderBy('reviews_count', 'desc');
                    break;
                case 'comments_asc':
                    $query->withCount('reviews')->orderBy('reviews_count', 'asc');
                    break;
            }
        }

        $products = $query->paginate(9)->withQueryString();
        return view('products.index', compact('products', 'sizes', 'colors'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function filter(Request $request)
    {
        // get color and size
        $sizes = ProductVariant::select('size')->distinct()->get();
        $colors = ProductVariant::select('color')->distinct()->get();

        $query = Product::with('reviews', 'variants')
            ->where('name', 'like', '%' . $request->input('query') . '%');
    
        // Filter
        if ($request->filled('color')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('color', $request->color);
            });
        }

        if ($request->filled('size')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size', $request->size);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
    
        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rating_desc':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                    break;
                case 'rating_asc':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'comments_desc':
                    $query->withCount('reviews')->orderBy('reviews_count', 'desc');
                    break;
                case 'comments_asc':
                    $query->withCount('reviews')->orderBy('reviews_count', 'asc');
                    break;
            }
        }

        $products = $query->paginate(9)->withQueryString();

        return view('products.filter', compact('products', 'sizes', 'colors', 'request'));
    }
}
