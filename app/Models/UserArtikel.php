<?php

// app/Models/Artikel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArtikel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'artikel_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artikel()
    {
        return $this->belongsTo(Article::class);
    }
}