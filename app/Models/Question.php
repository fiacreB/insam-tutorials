<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'slug',
        'chapter_id',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
    public function chapter()
    {
        return  $this->belongsTo('\App\Models\Chapter', 'chapter_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
