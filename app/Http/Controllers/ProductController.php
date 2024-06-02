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
        $reviews = $product->reviews()->latest()->paginate(10); // Paginasi reviews
        return view('products.show', compact('product', 'reviews'));
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

    public function liveSearch(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $output = '';
            
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $output .= '<a href="' . route('products.show', $product->id) . '" class="block p-2 hover:bg-gray-200 border-t first:border-t-0 last:border-b-0">';
                    $output .= '<div class="flex items-center space-x-4">';
                    $output .= '<img src="' . $product->image . '" class="w-16 h-16 object-cover rounded-lg">';
                    $output .= '<p class="text-sm font-medium text-gray-900">' . $product->name . '</p>';
                    $output .= '</div>';
                    $output .= '</a>';
                }
            } else {
                $output = '<div class="p-2">No results found</div>';
            }
            
            return response($output);
        }
    }    
}
