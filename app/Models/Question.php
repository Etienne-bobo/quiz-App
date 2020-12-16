<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Queston;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question', 	
        'quiz_id'
    ];
    private $order = 'DESC';
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function storeQuestion($data){
        $data ['quiz_id'] = $data ['quiz'];
        return Question::create($data);
    }

    public function getQuestions(){
        return Question::orderBy('created_at', $this->order)->with('quiz');
    }

    public function deleteQuestion($quizId){
        Question::where('quiz_id', $quizId)->delete();
    }
}
