<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category',
        'is_pinned',
        'status',
        'views_count',
        'reports_count',
    ];

    // Relasi ke User (Penulis Thread)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Balasan (Jika ada model Reply)
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // Helper untuk mengecek apakah thread sedang dilaporkan
    public function isReported()
    {
        return $this->reports_count > 0;
    }
}
