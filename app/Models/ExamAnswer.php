<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    public $table = "exams_answers";

    protected $fillable = [
        'attempt_id',
        'question_id',
        'slug',
        'answer_id'
    ];

    public function questions()
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
    public function answers()
    {
        return $this->hasOne(Answer::class, 'id', 'answer_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
