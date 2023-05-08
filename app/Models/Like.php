<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'slug',
        'lesson_id',
        'chapter_id',
    ];



    public function cours()
    {
        return $this->belongsTo('\App\Models\Lesson', 'lesson_id');
    }
    public function sujets()
    {
        return $this->belongsTo('\App\Models\Chapter', 'sujets_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
