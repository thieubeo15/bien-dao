<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // --- 1. QUẢN LÝ USER ---
    public function users()
    {
        $users = User::all();
        // Trả về view (bạn sẽ tạo view này sau)
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'Đã thêm thành viên mới!');
    }

    public function destroyUser($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa thành viên!');
    }

    // --- 2. QUẢN LÝ DANH MỤC ---
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Đã thêm danh mục!');
    }

    public function destroyCategory($id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa danh mục!');
    }

    // --- 3. QUẢN LÝ THÔNG BÁO (DOCUMENTS) ---
    public function documents()
    {
        $documents = DB::table('documents')->latest()->get();
        return view('admin.documents', compact('documents'));
    }

    public function storeDocument(Request $request)
    {
        $request->validate(['title' => 'required']);
        
        DB::table('documents')->insert([
            'title' => $request->title,
            'link' => $request->link,
            'is_new' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->back()->with('success', 'Đã đăng thông báo!');
    }

    public function destroyDocument($id)
    {
        DB::table('documents')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa thông báo!');
    }

    // --- 4. QUẢN LÝ BÀI VIẾT (ADMIN) ---
    public function posts()
    {
        // Lấy tất cả bài viết, mới nhất lên đầu, phân trang 10 bài
        $posts = \App\Models\Post::latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function destroyPost($id)
    {
        \App\Models\Post::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa bài viết vi phạm!');
    }
}