<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model {
    protected $fillable = ['user_id', 'dokter_id', 'keluhan', 'status', 'scheduled_date', 'scheduled_time', 'catatan_dokter'];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function dokter() { return $this->belongsTo(User::class, 'dokter_id'); }

    public function messages() { return $this->hasMany(Message::class, 'janji_temu_id'); }
}