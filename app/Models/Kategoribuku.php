<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribuku extends Model
{
    use HasFactory;

    protected $table = 'kategoribukus';

    protected $fillable = [
        'kategori',
    ];

    public function databuku()
    {
        return $this->belongsToMany(Databuku::class);
    }

}
