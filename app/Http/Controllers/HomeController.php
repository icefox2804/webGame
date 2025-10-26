<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    // Trang chủ - hiển thị danh sách game
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Tìm kiếm theo tên
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Lọc theo giá
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Lọc theo độ tuổi
        if ($request->has('age_rating') && $request->age_rating != '') {
            $query->where('age_rating', '<=', $request->age_rating);
        }

        // Sắp xếp
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        // Carousel dùng dữ liệu tĩnh - không load từ database
        $carouselVideos = [];

        // Lấy game theo category (không dùng pagination)
        $newGames = Product::with('category')->latest()->limit(8)->get();
        $actionGames = Product::with('category')->where('category_id', 1)->limit(8)->get();
        $rpgGames = Product::with('category')->where('category_id', 2)->limit(8)->get();

        return view('home', compact('products', 'categories', 'carouselVideos', 'newGames', 'actionGames', 'rpgGames'));
    }

    // Hiển thị game theo danh mục
    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(10);
        $categories = Category::all();

        return view('pages.categories.index', compact('category', 'products', 'categories'));
    }

    // Hiển thị chi tiết game
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }
}
