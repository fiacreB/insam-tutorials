<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'visits',
        'video_provider',
        'video_link',
        'video_path',
        'description',
        'chapter_id',
    ];


    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function likes()
    {
        return $this->hasMany('\App\Models\Like', 'lesson_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
