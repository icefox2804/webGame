<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'age_rating' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'name.required' => 'Tên game không được để trống',
            'name.max' => 'Tên game không được vượt quá 255 ký tự',
            'price.required' => 'Giá game không được để trống',
            'price.numeric' => 'Giá game phải là số',
            'price.min' => 'Giá game phải lớn hơn 0',
            'category_id.required' => 'Thể loại game không được để trống',
            'category_id.exists' => 'Thể loại game không tồn tại',
            'age_rating.required' => 'Độ tuổi game không được để trống',
            'age_rating.integer' => 'Độ tuổi game phải là số',
            'age_rating.min' => 'Độ tuổi game phải lớn hơn 0',
            'stock.required' => 'Số lượng không được để trống',
            'stock.integer' => 'Số lượng phải là số nguyên',
            'stock.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'image.image' => 'File phải là ảnh',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif, webp',
            'image.max' => 'Ảnh không được vượt quá 2MB',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id', 'age_rating', 'stock']);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                
                // Kiểm tra file hợp lệ
                if (!$image->isValid()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'File ảnh không hợp lệ!']);
                }

                // Tạo thư mục nếu chưa có
                if (!file_exists(public_path('images'))) {
                    mkdir(public_path('images'), 0777, true);
                }

                // Upload ảnh
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;

            } catch (\Exception $e) {
                \Log::error('Upload image failed: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Lỗi khi upload ảnh: ' . $e->getMessage()]);
            }
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Thêm game thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'age_rating' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ], [
            'name.required' => 'Tên game không được để trống',
            'name.max' => 'Tên game không được vượt quá 255 ký tự',
            'price.required' => 'Giá game không được để trống',
            'price.numeric' => 'Giá game phải là số',
            'price.min' => 'Giá game phải lớn hơn 0',
            'category_id.required' => 'Thể loại game không được để trống',
            'category_id.exists' => 'Thể loại game không tồn tại',
            'age_rating.required' => 'Độ tuổi game không được để trống',
            'age_rating.integer' => 'Độ tuổi game phải là số',
            'age_rating.min' => 'Độ tuổi game phải lớn hơn 0',
            'stock.required' => 'Số lượng không được để trống',
            'stock.integer' => 'Số lượng phải là số nguyên',
            'stock.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'image.image' => 'File phải là ảnh',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif, webp',
            'image.max' => 'Ảnh không được vượt quá 5MB',
        ]);

        $data = $request->only(['name', 'description', 'price', 'category_id', 'age_rating', 'stock']);

        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                
                // Kiểm tra file hợp lệ
                if (!$image->isValid()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'File ảnh không hợp lệ!']);
                }

                // Tạo thư mục nếu chưa có
                if (!file_exists(public_path('images'))) {
                    mkdir(public_path('images'), 0777, true);
                }

                // Xóa ảnh cũ nếu có
                if ($product->image && file_exists(public_path('images/' . $product->image))) {
                    unlink(public_path('images/' . $product->image));
                }

                // Upload ảnh mới
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;

            } catch (\Exception $e) {
                \Log::error('Upload image failed: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Lỗi khi upload ảnh: ' . $e->getMessage()]);
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật game thành công!');
    }

    // Xóa sản phẩm (soft delete)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Đã chuyển game vào thùng rác!');
    }

    // Hiển thị danh sách sản phẩm đã xóa
    public function trash()
    {
        $products = Product::onlyTrashed()->with('category')->paginate(10);
        return view('admin.products.trash', compact('products'));
    }

    // Khôi phục sản phẩm
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.trash')
            ->with('success', 'Đã khôi phục game thành công!');
    }

    // Xóa vĩnh viễn sản phẩm
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        
        // Xóa ảnh nếu có
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->forceDelete();

        return redirect()->route('admin.products.trash')
            ->with('success', 'Đã xóa vĩnh viễn game!');
    }
}
