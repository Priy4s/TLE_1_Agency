<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['user_id', 'question_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');

    }
}

