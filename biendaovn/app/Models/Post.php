<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Cho phép nhập dữ liệu vào các cột này
    protected $fillable = [
        'title', 
        'summary', 
        'content', 
        'image', 
        'user_id', 
        'category_id'
    ];

    // Quan hệ: Bài viết thuộc về 1 Danh mục
 public function category()
{
    return $this->belongsTo(Category::class);
}

    // Quan hệ: Bài viết thuộc về 1 Tác giả (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}