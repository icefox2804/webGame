<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    /**
     * Display trash dashboard with statistics and recent deleted items
     */
    public function index()
    {
        // Get counts
        $productsCount = Product::onlyTrashed()->count();
        $categoriesCount = Category::onlyTrashed()->count();
        $contactsCount = Contact::onlyTrashed()->count();
        
        // Get recent deleted items (latest 5)
        $recentProducts = Product::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->take(5)
            ->get();
            
        $recentCategories = Category::onlyTrashed()
            ->withCount('products')
            ->latest('deleted_at')
            ->take(5)
            ->get();
            
        $recentContacts = Contact::onlyTrashed()
            ->latest('deleted_at')
            ->take(5)
            ->get();
        
        return view('admin.trash.index', compact(
            'productsCount',
            'categoriesCount', 
            'contactsCount',
            'recentProducts',
            'recentCategories',
            'recentContacts'
        ));
    }
}

