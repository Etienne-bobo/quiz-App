<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Answer;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question_id',
        'quiz_id',
     	'answer_id' 
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class);
    }
}
