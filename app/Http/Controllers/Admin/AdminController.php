<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Thống kê tổng quan
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalContacts = Contact::count();
        $totalUsers = User::count();
        
        // Thống kê theo thời gian
        $productsThisMonth = Product::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $contactsThisMonth = Contact::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $usersThisMonth = User::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        
        // Sản phẩm mới nhất
        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();
        
        // Liên hệ mới nhất
        $recentContacts = Contact::latest()
            ->take(5)
            ->get();
        
        // Thống kê theo thể loại
        $categoryStats = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();
        
        // Dữ liệu chart - Products by month (6 tháng gần nhất)
        $productsChart = [];
        $contactsChart = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->format('m');
            $year = $date->format('Y');
            $monthName = $date->format('M Y');
            
            $productsChart[] = [
                'label' => $monthName,
                'value' => Product::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->count()
            ];
            
            $contactsChart[] = [
                'label' => $monthName,
                'value' => Contact::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->count()
            ];
        }
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalContacts',
            'totalUsers',
            'productsThisMonth',
            'contactsThisMonth',
            'usersThisMonth',
            'recentProducts',
            'recentContacts',
            'categoryStats',
            'productsChart',
            'contactsChart'
        ));
    }
}
