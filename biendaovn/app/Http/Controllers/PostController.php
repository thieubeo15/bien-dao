<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 1. HIỆN FORM VIẾT BÀI
    public function create()
    {
        // Lấy danh mục để hiện trong thẻ <select>
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // 2. LƯU BÀI VIẾT & UPLOAD ẢNH
    public function store(Request $request)
    {
        // a. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho up ảnh, tối đa 2MB
        ]);

        // b. Xử lý Upload ảnh (Nếu có chọn ảnh)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Lưu vào thư mục: storage/app/public/posts
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // c. Lưu vào Database
        Post::create([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'content' => $request->input('content'),
            'image' => $imagePath, // Lưu đường dẫn ảnh
            'user_id' => Auth::id(), // Lấy ID người đang đăng nhập
            'category_id' => $request->input('category_id'),
        ]);

        // d. Thông báo & Quay lại
        return redirect()->route('dashboard')->with('success', 'Đã đăng bài viết thành công!');
    }
}