<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public $fillable = [
        'examen_name ',
        'slug',
        'chapter_id ',
        // 'date',
        'time',
        // 'attempt',
    ];


    public function subjects()
    {
        return  $this->belongsTo('\App\Models\Chapter', 'chapter_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
