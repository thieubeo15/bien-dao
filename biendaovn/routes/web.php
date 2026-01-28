<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeaWeatherController;

// --- 1. TRANG CHỦ ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// [QUAN TRỌNG] Đã sửa thành PostController để hiện "Tin liên quan"
Route::get('/bai-viet/{id}', [PostController::class, 'show'])->name('posts.show');

// --- 2. CÁC ROUTE CÔNG KHAI KHÁC ---
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');
Route::get('/search', [HomeController::class, 'search'])->name('posts.search');


// --- 3. KHU VỰC THÀNH VIÊN (Cần đăng nhập) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/ckeditor/upload', [PostController::class, 'uploadImage'])->name('ckeditor.upload');
    // Quản lý Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Viết & Sửa bài (User thường cũng làm được)
    Route::get('/viet-bai', [PostController::class, 'create'])->name('posts.create');
    Route::post('/viet-bai', [PostController::class, 'store'])->name('posts.store');
    
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
});


// --- 4. KHU VỰC ADMIN (Chỉ Admin mới vào được) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Quản lý User
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    
    // Quản lý Danh mục
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
    
    // Quản lý Thông báo
    Route::get('/documents', [AdminController::class, 'documents'])->name('admin.documents');
    Route::post('/documents', [AdminController::class, 'storeDocument'])->name('admin.documents.store');
    Route::delete('/documents/{id}', [AdminController::class, 'destroyDocument'])->name('admin.documents.destroy');

    // Quản lý Bài viết (Admin xem bài của người khác)
    // Đã xóa dòng trùng lặp bên dưới và dùng dòng này làm chuẩn
    Route::get('/posts', [PostController::class, 'adminPosts'])->name('admin.posts');
    Route::delete('/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');

    // [QUAN TRỌNG] Đưa SeaWeather vào đây để bảo mật & gọn code
    // URL sẽ tự động là: /admin/sea-weather
    Route::resource('sea-weather', SeaWeatherController::class)->names('admin.sea-weather');
});

require __DIR__.'/auth.php';