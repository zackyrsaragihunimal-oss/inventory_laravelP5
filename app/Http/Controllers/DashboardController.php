<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockMovement;
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'Produk' => Product::count(), 'Kategori' => Category::count(),
            'Pemasok' => Supplier::count(), 'Total stok' => Product::sum('stock')
        ];
        $lowStock = Product::with('category')->where('stock', '<=', 5)->orderBy('stock')->limit(10)->get();
        return view('dashboard', compact('stats', 'lowStock'));
    }
}
