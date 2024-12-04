<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['user_id', 'question_id', 'answer'];

//    public static function updateOrCreate(array $array, array $array1)
//    {
//    }
//
//    public static function where(string $string, $id)
//    {
//    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'answer');
    }
}

