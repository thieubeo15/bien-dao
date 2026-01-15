<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    // Cho phép nhập dữ liệu vào cột 'name'
    protected $fillable = ['name'];

    // Thiết lập quan hệ: 1 Danh mục có nhiều Bài viết
   public function posts()
{
    return $this->hasMany(Post::class);
}
}