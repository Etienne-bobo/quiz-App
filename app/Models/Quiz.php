<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Result;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 	
        'description' ,	
        'minutes'
    ];
    private $order = 'DESC';
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
    
    public function getAssignQuiz(){
        return Quiz::orderBy('created_at', $this->order)->with('users');
    }

    public function hasQuizAttempted(){
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach($user as $u){
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }
}
