<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

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
}
