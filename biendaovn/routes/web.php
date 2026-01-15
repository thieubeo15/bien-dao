<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

// --- 1. TRANG CHỦ ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bai-viet/{id}', [HomeController::class, 'show'])->name('posts.show');

// --- 2. KHU VỰC ĐĂNG NHẬP (Chung) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/viet-bai', [PostController::class, 'create'])->name('posts.create');
    Route::post('/viet-bai', [PostController::class, 'store'])->name('posts.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 3. KHU VỰC ADMIN (Chỉ Admin mới vào được) ---
// Tất cả các route bên trong nhóm này đều yêu cầu login VÀ có quyền admin
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

    // Quản lý Bài viết (Đã đưa vào bên trong nhóm Admin để bảo mật)
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::delete('/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
});
// Route lọc theo danh mục
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');

// Route tìm kiếm bài viết
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('posts.search');



require __DIR__.'/auth.php';