<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.categories.create');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Thêm thể loại thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Cập nhật thể loại thành công!');
    }

    // Xóa danh mục (soft delete)
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Đã chuyển thể loại vào thùng rác!');
    }

    // Hiển thị danh sách danh mục đã xóa
    public function trash()
    {
        $categories = Category::onlyTrashed()->withCount('products')->paginate(10);
        return view('admin.categories.trash', compact('categories'));
    }

    // Khôi phục danh mục
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.trash')
            ->with('success', 'Đã khôi phục thể loại thành công!');
    }

    // Xóa vĩnh viễn danh mục
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        
        // Kiểm tra xem có sản phẩm nào liên quan không
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.trash')
                ->with('error', 'Không thể xóa vĩnh viễn thể loại vì còn sản phẩm liên quan!');
        }

        $category->forceDelete();

        return redirect()->route('admin.categories.trash')
            ->with('success', 'Đã xóa vĩnh viễn thể loại!');
    }
}
