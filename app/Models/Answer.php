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

    public function storeAnswer($data, $question){
        foreach($data['options'] as $key=>$option){
            $is_correct=false;
            if($key == $data['correct_answer']){
                $is_correct = true;
            }
            if($key >= 1){
                $answer = Answer::create([
                    'question_id' => $question->id,
                    'answer' => $option,
                    'is_correct' => $is_correct
                ]);
            }
            
        }
    }
    public function deleteAnswer($questionId){
        Answer::where('question_id', $questionId)->delete();
    }
}
