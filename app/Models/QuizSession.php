<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['user_id', 'question_id', 'answers'];

    public function question()
    {
        return $this->belongsTo(QuestionOption::class, 'answers');
    }


}

