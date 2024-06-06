<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductVariant;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Exception;

class AdminController extends Controller
{
    private $columnCommands = ['waktu_order' => "created_at", 'nomor_id' => 'id', 'status' => 'status', 'kuantitas' => 'quantity', 'harga' => 'price', 'nama_produk' => 'name'];

    public function dashboard(Request $request)
    {
        $product = Product::all();
        $user = User::all();
        $sortRequest = $request->sort;
        $sortDirection = $request->direction;
        $chartType = $request->chart_type ?? 'status';

        if ($sortRequest == null || !in_array($sortRequest, array_keys($this->columnCommands))) {
            // Default sorting
            $recentOrders = Order::with(['items' => function ($query) {
                $query->orderBy($this->columnCommands['waktu_order'], 'desc');
            }])->paginate(6);
        } else {
            try {
                if ($sortRequest == 'kuantitas') {
                    $recentOrders = Order::with(['items'])
                        ->select('orders.*', \DB::raw('SUM(order_items.quantity) as total_quantity'))
                        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                        ->groupBy('orders.id')
                        ->orderBy('total_quantity', $sortDirection)
                        ->paginate(6);
                } else if ($sortRequest == 'status') {
                    $recentOrders = Order::with(['items'])
                        ->orderBy($this->columnCommands[$sortRequest], $sortDirection)
                        ->paginate(6);
                } else {
                    $recentOrders = Order::with(['items' => function ($query) use ($sortRequest, $sortDirection) {
                        $query->orderBy($this->columnCommands[$sortRequest], $sortDirection);
                    }])->paginate(6);
                }
            } catch (Exception $e) {
                $recentOrders = Order::with(['items' => function ($query) use ($sortRequest, $sortDirection) {
                    $query->orderBy($this->columnCommands[$sortRequest], $sortDirection);
                }])->paginate(6);
            }
        }

        $productCount = Product::count();
        $userCount = User::count();
        $orderCount = Order::count();
        $netSales = Order::where('status', 'selesai')->sum('total_price');

        // Charting
        $months = [];
        $chartData = [];

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $months[] = $month;

            if ($chartType == 'status') {
                $statuses = ['pending', 'diproses', 'dalam perjalanan', 'selesai', 'canceled'];
                foreach ($statuses as $status) {
                    $chartData[$status][] = Order::where('status', $status)
                        ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                        ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                        ->count();
                }
            } else if ($chartType == 'sales') {
                $chartData['selesai'][] = Order::where('status', 'selesai')
                    ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                    ->withSum('items', 'quantity')
                    ->get()
                    ->sum('items_sum_quantity');
            }
        }

        // Reverse arrays for correct chronological order
        $months = array_reverse($months);
        foreach ($chartData as $key => $data) {
            $chartData[$key] = array_reverse($data);
        }

        if ($chartType == 'status') {
            $chart = (new LarapexChart)->barChart()
                ->setTitle('Kuantitas Penjualan')
                ->setSubtitle('Berdasarkan status pesanan')
                ->setXAxis($months)
                ->setGrid()
                ->setMarkers($colors = ['#000000'])
                ->setFontFamily("Figtree")
                ->setDataset(array_map(function ($key, $data) {
                    return ['name' => ucfirst($key), 'data' => $data];
                }, array_keys($chartData), $chartData));
        } else if ($chartType == 'sales') {
            $chart = (new LarapexChart)->lineChart()
                ->setTitle('Produk Terjual')
                ->setSubtitle('Berdasarkan Produk Terjual')
                ->setXAxis($months)
                ->setGrid()
                ->setMarkers($colors = ['#000000'])
                ->setFontFamily("Figtree")
                ->setDataset([
                    [
                        'name' => 'Terjual',
                        'data' => $chartData['selesai']
                    ]
                ]);
        }

        return view('admin.dashboard', compact('product', 'user', 'recentOrders', 'productCount', 'userCount', 'orderCount', 'netSales', 'chart', 'months', 'chartData'));
    }

    // Orders
    public function showOrders($id)
    {
        $orders = Order::findOrFail($id)->load('items');
        return view('admin.orders.update', compact('orders'));
    }

    public function updateOrders(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // Products
    public function products()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productTable(Request $request)
    {
        $query = Product::query();

        // Pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Pengurutan
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order');
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate(5);
        $productVariants = ProductVariant::all();

        $tableView = view('admin.products.partials.product_table', compact('products', 'productVariants'))->render();
        $paginationView = view('admin.products.partials.pagination', compact('products'))->render();

        return response()->json(['table' => $tableView, 'pagination' => $paginationView]);
    }

    public function products_v2()
    {
        $products = Product::paginate(5);
        $productVariants = ProductVariant::all();
        return view('admin.products.products', compact('products', 'productVariants'));
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->save();

        return response()->json();
    }

    public function createProduct()
    {
        return view('admin.products.add');
    }

    public function storeProduct_v2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'imageFile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imageName' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $storagePath = public_path('storage/images');

        // Generate a unique file name using "sepatu" + timestamp + original extension
        $fileName = $request->imageName;

        // Store the file in the public storage folder with the custom name
        $request->file('imageFile')->move($storagePath, $fileName);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $request->imageName;
        $product->save();

        $productVariant = new ProductVariant;
        $productVariant->product_id = $product->id;
        $productVariant->size = 37;
        $productVariant->color = 'black';
        $productVariant->stock = 0;
        $productVariant->save();

        return redirect()->route('admin.products.products')->with('success', 'Produk berhasil ditambah. Silakan tambahkan stok dengan meng-edit produk!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function editProduct_v2($id)
    {
        $product = Product::findOrFail($id);
        $productVariants = ProductVariant::where('product_id', $id)->get();
        return view('admin.products.edit', compact('product', 'productVariants'));
    }

    public function editStock($id)
    {
        $product = Product::findOrFail($id);
        $productVariant = ProductVariant::where('product_id', $id)->get();
        return view('admin.products.add_stock', compact('product', 'productVariant'));
    }

    public function updateStock(Request $request, $id)
    {
        if (empty($request->sizes)) {
            return redirect()->back()
                ->withErrors("Tidak ada data baris yang dimasukkan.")
                ->withInput();
        }

        $validator = Validator::make($request->all(), [
            'sizes' => 'required|array',
            'sizes.*' => 'required|integer|min:15',
            'colors' => 'required|array',
            'colors.*' => 'required|alpha|max:32',
            'stock' => 'required|array',
            'stock.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($id);

        $len = count($request->sizes);

        for ($i = 0; $i < $len; $i++) {
            $productVariant = new ProductVariant;
            $productVariant->product_id = $product->id;
            $productVariant->size = $request->sizes[$i];
            $productVariant->color = $request->colors[$i];
            $productVariant->stock = $request->stock[$i];
            $productVariant->save();
        }

        // return response()->json(['sizes' => $request->sizes, 'colors' => $request->colors, 'stock' => $request->stock, 'product_id' => $id, 'len' => $len]);
        return redirect()->route('admin.products.products')->with('success', 'Informasi stok produk berhasil diperbarui.');
    }

    public function showStock($id)
    {
        $product = Product::findOrFail($id);
        $productVariant = ProductVariant::where('product_id', $id)->get();
        return view('admin.products.delete_stock', compact('product', 'productVariant'));
    }

    public function deleteStock($id, $ret)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();

        return response()->redirectTo('admin/products/delete/stock/v2/' . $ret)->with('success', 'Stok berhasil dihapus.');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        // $product->stock = $request->stock;
        $product->save();

        return response()->json(['message' => 'Produk berhasil diperbarui.']);
    }

    public function updateProduct_v2(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|array',
            'stock.*' => 'required|integer|min:0',
            'variant_id' => 'required|array',
            'variant_id.*' => 'required|integer',
            'imageFile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imageName' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $storagePath = public_path('storage/images');

        // Generate a unique file name using "sepatu" + timestamp + original extension
        $fileName = $request->imageName;

        // Store the file in the public storage folder with the custom name
        $request->file('imageFile')->move($storagePath, $fileName);

        // Update product details
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $fileName;

        // Update each product variant's stock
        $variantIds = $request->variant_id;
        $stocks = $request->stock;

        foreach (array_combine($variantIds, $stocks) as $variantId => $stock) {
            $productVariant = ProductVariant::find($variantId);
            if ($productVariant) {
                $productVariant->stock = $stock;
                $productVariant->save();
            }
        }

        $product->save();

        return redirect()->route('admin.products.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus.']);
    }

    // Users
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function userTable(Request $request)
    {
        $query = User::query();

        // Pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Pengurutan
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order');
            $query->orderBy($sortBy, $sortOrder);
        }

        $users = $query->paginate(10);

        $tableView = view('admin.users.partials.user_table', compact('users'))->render();
        $mobileView = view('admin.users.partials.mobile_user_table', compact('users'))->render();
        $paginationView = view('admin.users.partials.pagination', compact('users'))->render();

        return response()->json(['table' => $tableView, 'mobile' => $mobileView, 'pagination' => $paginationView]);
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'userrole' => 'required|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->userrole = $request->userrole;
        $user->save();

        return response()->json(['message' => 'User berhasil dibuat.']);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'userrole' => 'required|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->userrole = $request->userrole;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User berhasil diperbarui.']);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus.']);
    }
}
