<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'janji_temu_id',
        'sender_id',
        'message',
        'is_read',
        'is_edited',
        'medicine_id',
    ];

    public function janjiTemu()
    {
        return $this->belongsTo(JanjiTemu::class, 'janji_temu_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
