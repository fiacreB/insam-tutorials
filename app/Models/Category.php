<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'parent_id'
    ];



    // public function chapters()
    // {
    //     return $this->hasMany('\App\Models\Chapter', 'categoriesid');
    // }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
