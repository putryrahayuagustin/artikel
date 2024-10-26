<?php

// app/Models/Artikel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'artikel';


    protected $fillable = [
        'title',
        'user_id',
        'category',
        'image',
        'body',
    ];

    // Relasi ke model User
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}