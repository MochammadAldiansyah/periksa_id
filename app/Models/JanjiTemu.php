<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model {
    protected $fillable = ['user_id', 'dokter_id', 'tanggal', 'status'];

    public function dokter() { return $this->belongsTo(Dokter::class); }
    public function user() { return $this->belongsTo(User::class); }
}   