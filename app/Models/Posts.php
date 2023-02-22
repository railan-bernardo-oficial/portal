<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'category',
        'title',
        'description',
        'image',
        'content',
    ];

    //juntar post com a categoria
    public function categorie()
    {
        return $this->belongsTo(Categories::class, 'category');
    }

    //juntar post com o autor
    public function autho()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
