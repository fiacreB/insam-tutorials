<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'first',
        'description',
        'course_id',
    ];

    public function lessons()
    {
        return $this->hasMany('\App\Models\Lesson', 'chapter_id');
    }

    public function course()
    {
        return  $this->belongsTo('\App\Models\Course', 'course_id');
    }

    public function likes()
    {
        return $this->hasMany('\App\Models\Like', 'chapter_id');
    }
    public function questions()
    {
        return $this->hasMany('\App\Models\Question', 'chapter_id');
    }
    public function exams()
    {
        return $this->hasMany('\App\Models\Exam', 'chapter_id');
    }
    public function exam_attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'chapter_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
