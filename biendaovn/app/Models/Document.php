<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Khai báo các cột được phép thêm dữ liệu vào
    protected $fillable = [
        'title',
        'link',
        'is_new',
    ];
}