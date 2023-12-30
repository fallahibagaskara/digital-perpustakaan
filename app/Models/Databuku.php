<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databuku extends Model
{
    use HasFactory;

    protected $table = 'databukus';

    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'deskripsi',
        'jumlah',
        'name',
        'file',
        'cover',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
