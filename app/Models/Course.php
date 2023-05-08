<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'category_id',
    ];

    public function category()
    {
        return  $this->belongsTo('\App\Models\Category', 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany('\App\Models\Chapter');
    }

    public function lessons()
    {
        return $this->hasMany('\App\Models\Lesson');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
