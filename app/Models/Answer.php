<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'question_id',
        'answer',
        'is_correct',
    ];

    public function question()
    {
        return $this->hasOne(Question::class, 'id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
