<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    public $table = "exams_attempt";

    protected $fillable = [
        'chapter_id',
        'slug',
        'user_id',
        'status',
        'valid',
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function chapter()
    {
        return $this->hasOne(Chapter::class, 'id', 'chapter_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
