<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',	
        'answer',
        'is_correct' 
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
