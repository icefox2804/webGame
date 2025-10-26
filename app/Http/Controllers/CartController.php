<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('pages.cart.index', compact('cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Kiểm tra tình trạng hàng
        if (isset($product->stock) && $product->stock <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm ' . $product->name . ' hiện đã hết hàng!');
        }
        
        $cart = session()->get('cart', []);
        
        // Kiểm tra số lượng trong kho
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + 1;
            if (isset($product->stock) && $newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Số lượng trong kho không đủ! Chỉ còn ' . $product->stock . ' sản phẩm.');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "stock" => $product->stock ?? null
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Đã thêm ' . $product->name . ' vào giỏ hàng!');
    }

    // Mua ngay - Thêm vào giỏ và chuyển đến trang giỏ hàng
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Kiểm tra tình trạng hàng
        if (isset($product->stock) && $product->stock <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm ' . $product->name . ' hiện đã hết hàng!');
        }
        
        $cart = session()->get('cart', []);
        
        // Kiểm tra số lượng trong kho
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + 1;
            if (isset($product->stock) && $newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Số lượng trong kho không đủ! Chỉ còn ' . $product->stock . ' sản phẩm.');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "stock" => $product->stock ?? null
            ];
        }
        
        session()->put('cart', $cart);
        
        // Chuyển hướng đến trang giỏ hàng thay vì quay lại
        return redirect()->route('cart.index')->with('success', 'Đã thêm ' . $product->name . ' vào giỏ hàng!');
    }

    // Cập nhật số lượng sản phẩm
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            // Kiểm tra sản phẩm còn trong kho
            $product = Product::find($request->id);
            
            if ($product && isset($product->stock)) {
                if ($product->stock <= 0) {
                    return redirect()->back()->with('error', 'Sản phẩm ' . $product->name . ' đã hết hàng!');
                }
                
                if ($request->quantity > $product->stock) {
                    return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá số lượng trong kho! Chỉ còn ' . $product->stock . ' sản phẩm.');
                }
            }
            
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    // Lấy số lượng sản phẩm trong giỏ hàng (dùng cho AJAX)
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        
        return response()->json(['count' => $count]);
    }

    // Hiển thị trang thanh toán
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        
        // Kiểm tra tình trạng hàng của tất cả sản phẩm trong giỏ
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            
            if (!$product) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('error', 'Một số sản phẩm không còn tồn tại!');
            }
            
            if (isset($product->stock)) {
                if ($product->stock <= 0) {
                    return redirect()->route('cart.index')->with('error', 'Sản phẩm "' . $product->name . '" đã hết hàng! Vui lòng xóa khỏi giỏ hàng.');
                }
                
                if ($item['quantity'] > $product->stock) {
                    return redirect()->route('cart.index')->with('error', 'Sản phẩm "' . $product->name . '" chỉ còn ' . $product->stock . ' sản phẩm trong kho!');
                }
            }
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('pages.cart.checkout', compact('cart', 'total'));
    }

    // Xử lý đặt hàng
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:bank_transfer,momo',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Lưu thông tin đơn hàng vào session (sau này có thể lưu vào database)
        $order = [
            'order_id' => 'ORD' . time(),
            'customer_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'items' => $cart,
            'total' => $total,
            'created_at' => now(),
        ];

        // Xóa giỏ hàng
        session()->forget('cart');
        
        // Lưu thông tin đơn hàng vào session để hiển thị trang cảm ơn
        session()->put('last_order', $order);

        return redirect()->route('cart.success');
    }

    // Trang cảm ơn sau khi đặt hàng
    public function success()
    {
        $order = session()->get('last_order');
        
        if (!$order) {
            return redirect()->route('home');
        }

        return view('pages.cart.success', compact('order'));
    }
}
