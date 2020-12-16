<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;
use App\Models\Quiz;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 	
        'description' ,	
        'minutes'
    ];
    
    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'quiz_user');
    }
    public function assignExam($data){
        $quizId = $data['quiz_id'];
        $quiz = Quiz::find($quizId);
        $userId = $data['user_id'];
        return $quiz->users()->syncWithoutDetaching($userId);
    }
    
}
