<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Lấy 3 bài mới nhất để làm Slide
        $slides = Post::latest()->take(3)->get();

        // 2. Lấy danh sách bài viết phân trang (5 bài/trang)
        // Lưu ý: Không nên dùng skip() chung với paginate() vì sẽ lỗi link phân trang
        // Ta cứ lấy toàn bộ, trang đầu sẽ trùng 3 bài slide nhưng nhìn sẽ đầy đặn hơn
        $posts = Post::latest()->paginate(5);

        // 3. Lấy thông báo (Documents) - Dùng Model thay vì DB table để tránh lỗi format date
        $documents = Document::latest()->take(5)->get();

        // 4. Lấy danh mục để hiện lên Menu
        $categories = Category::all();

        return view('welcome', compact('slides', 'posts', 'documents', 'categories'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function category($id)
    {
        $currentCategory = Category::findOrFail($id);
        $categories = Category::all();
        $documents = Document::latest()->take(5)->get();

        // Lọc bài theo danh mục và phân trang 5 bài
        $posts = Post::where('category_id', $id)->latest()->paginate(5);

        return view('welcome', compact('posts', 'categories', 'documents', 'currentCategory'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $categories = Category::all();
        $documents = Document::latest()->take(5)->get();

        // Tìm kiếm và phân trang 5 bài
        $posts = Post::where(function($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                      ->orWhere('summary', 'LIKE', "%{$keyword}%");
            })
            ->latest()
            ->paginate(5);

        return view('welcome', compact('posts', 'categories', 'documents', 'keyword'));
    }
}