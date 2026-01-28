<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post; // [MỚI] Thêm dòng này để gọi được Model Post
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // --- 1. QUẢN LÝ USER ---
    public function users()
    {
        $users = User::all();
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
        // Lấy danh sách thông báo cũ
        $documents = DB::table('documents')->latest()->get();
        
        // [MỚI] Lấy danh sách bài viết để admin có thể chọn làm link nhanh
        // Chỉ lấy id và title cho nhẹ database
        $posts = Post::latest()->select('id', 'title')->get(); 

        // Truyền cả $documents và $posts sang view
        return view('admin.documents', compact('documents', 'posts'));
    }

   public function storeDocument(Request $request)
{
    $request->validate([
        'title' => 'required',
    ]);

    // LOGIC TỰ ĐỘNG CHỌN LINK
    // Ưu tiên 1: Link thủ công (nếu admin nhập)
    // Ưu tiên 2: Link từ bài viết đã chọn
    $finalLink = $request->link;
    
    if (empty($finalLink) && !empty($request->post_id_link)) {
        $finalLink = $request->post_id_link;
    }

    Document::create([
        'title' => $request->title,
        'link'  => $finalLink, // Lưu cái link cuối cùng vào
        'content' => null, // Hoặc nội dung nếu có
    ]);

    return redirect()->back()->with('success', 'Đăng thông báo thành công!');
}

    public function destroyDocument($id)
    {
        DB::table('documents')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa thông báo!');
    }

    // --- 4. QUẢN LÝ BÀI VIẾT (ADMIN) ---
    public function posts()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function destroyPost($id)
    {
        Post::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa bài viết vi phạm!');
    }
}