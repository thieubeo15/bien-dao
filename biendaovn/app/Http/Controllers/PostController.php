<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\SeaWeather; // Thêm dòng này để gọi được Model thời tiết
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class PostController extends Controller
{
    // 1. HIỆN FORM VIẾT BÀI
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // 2. LƯU BÀI VIẾT & UPLOAD ẢNH
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255|unique:posts,title',
            'category_id' => 'required|exists:categories,id',
            'summary'     => 'required|string|max:500',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required'       => 'Tiêu đề không được để trống.',
            'title.unique'         => 'Tiêu đề đã tồn tại.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'summary.required'     => 'Vui lòng nhập mô tả ngắn.',
            'content.required'     => 'Nội dung không được để trống.',
            'image.max'            => 'Ảnh không được vượt quá 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title'       => $request->input('title'),
            'summary'     => $request->input('summary'),
            'content'     => $request->input('content'),
            'image'       => $imagePath,
            'user_id'     => Auth::id(),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Đã đăng bài viết thành công!');
    }

    // 3. FORM SỬA BÀI
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            return redirect()->route('dashboard')
                ->with('error', 'Bạn không có quyền sửa bài viết này!');
        }

        return view('posts.edit', compact('post', 'categories'));
    }

    // 4. CẬP NHẬT BÀI VIẾT
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255|unique:posts,title,' . $id,
            'category_id' => 'required|exists:categories,id',
            'summary'     => 'required|string|max:500',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'image.max'      => 'Ảnh không được quá 2MB.',
        ]);

        $post->fill($request->only(['title', 'category_id', 'summary', 'content']));

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.my-posts')
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    // 5. BÀI VIẾT CỦA TÔI
    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('posts.my-post', compact('posts'));
    }

    // 6. XÓA BÀI
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::id() !== $post->user_id) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bài này!');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Đã xóa bài viết thành công!');
    }

    // 7. ADMIN XEM BÀI CỦA USER KHÁC
    public function adminPosts()
    {
        $currentAdminId = Auth::id();
        $posts = Post::where('user_id', '!=', $currentAdminId)
            ->latest()
            ->paginate(10);

        return view('admin.posts', compact('posts'));
    }

// 8. XEM CHI TIẾT BÀI VIẾT (ĐÃ SỬA LỖI MẤT MENU)
    public function show($id)
    {
        // a. Lấy bài viết hiện tại
        $post = Post::with('user')->findOrFail($id);

        // b. [THÊM DÒNG NÀY] Lấy danh mục để hiển thị lên thanh Menu (Navbar)
        // Nếu thiếu dòng này, menu ở trên cùng sẽ bị trắng trơn
        $categories = Category::all(); 

        // c. Xử lý TIN LIÊN QUAN
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $id)
                            ->latest()
                            ->take(4)
                            ->get();

        // d. Lấy dữ liệu THỜI TIẾT (Cho Sidebar)
        $weathers = SeaWeather::latest()->take(5)->get();

        // e. Lấy dữ liệu THÔNG BÁO (Cho Sidebar)
        $documents = Document::latest()->take(5)->get(); 

        // f. Trả về View (Nhớ thêm 'categories' vào compact)
        return view('posts.show', compact('post', 'relatedPosts', 'weathers', 'documents', 'categories'));
    }

    // Hàm xử lý upload ảnh từ CKEditor
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            // 1. Lấy thông tin file
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            
            // 2. Đổi tên file để không bị trùng (Thêm thời gian vào tên)
            $fileName = $fileName . '_' . time() . '.' . $extension;
            
            // 3. Lưu file vào thư mục public/media
            // Lưu vào disk 'public', thư mục 'media'
$request->file('upload')->storeAs('media', $fileName, 'public');
            
            // 4. Trả về đường dẫn ảnh (URL) để trình soạn thảo hiển thị
            $url = asset('storage/media/' . $fileName);
            
            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url
            ]);
        }
    }
}