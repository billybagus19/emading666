<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';
    
    protected $fillable = [
        'id_user',
        'id_artikel', 
        'judul',
        'pesan',
        'tipe',
        'dibaca'
    ];
    
    protected $casts = [
        'dibaca' => 'boolean'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel', 'id_artikel');
    }
}
