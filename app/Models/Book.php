<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',

        'image',
        'title',
        'views',
        'pdf_path',
        'description',
        'book_categories_id',
    ];

    public function category()
    {
        return $this->belongsTo('\App\Models\BookCategory', 'book_categories_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
