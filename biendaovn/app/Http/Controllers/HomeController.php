<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Document;
use App\Models\SeaWeather; // QUAN TRỌNG: Phải thêm dòng này để lấy dữ liệu thời tiết

class HomeController extends Controller
{
    // File: app/Http/Controllers/HomeController.php

public function index()
{
    // 1. Biến $posts (Cho phần "Tin mới nhất" ở trên)
    $posts = Post::latest()->paginate(5); 

    // 2. Biến $categoriesWithPosts (Cho phần danh mục bên dưới)
    $categoriesWithPosts = Category::with(['posts' => function($query) {
        $query->latest()->take(4);
    }])->get();

    // Các biến khác (Slide, Sidebar...)
    $slides = Post::latest()->take(3)->get();
    $documents = Document::latest()->take(5)->get();
    $weathers = SeaWeather::latest()->take(5)->get();
    $categories = Category::all();

    // TRUYỀN HẾT VÀO VIEW
    return view('welcome', compact('posts', 'categoriesWithPosts', 'slides', 'documents', 'weathers', 'categories'));
}
    public function show($id)
    {
        $post = Post::findOrFail($id);
        // Khi xem chi tiết vẫn cần lấy weathers nếu sidebar vẫn hiện ở trang này
        $weathers = SeaWeather::latest()->take(5)->get(); 
        return view('posts.show', compact('post', 'weathers'));
    }

    public function category($id)
    {
        $currentCategory = Category::findOrFail($id);
        $categories = Category::all();
        $documents = Document::latest()->take(5)->get();
        $weathers = SeaWeather::latest()->take(5)->get();

        $posts = Post::where('category_id', $id)->latest()->paginate(5);

        return view('welcome', compact('posts', 'categories', 'documents', 'currentCategory', 'weathers'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $categories = Category::all();
        $documents = Document::latest()->take(5)->get();
        $weathers = SeaWeather::latest()->take(5)->get();

        $posts = Post::where(function($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                      ->orWhere('summary', 'LIKE', "%{$keyword}%");
            })
            ->latest()
            ->paginate(5);

        return view('welcome', compact('posts', 'categories', 'documents', 'keyword', 'weathers'));
    }
}