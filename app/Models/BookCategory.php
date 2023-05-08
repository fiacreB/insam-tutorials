<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'parent_id'
    ];

    public function books()
    {
        return $this->hasMany('\App\Models\Book', 'book_categories_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent(){
        return $this->belongsTo(BookCategory::class, 'parent_id');
    }
}
