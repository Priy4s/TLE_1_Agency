<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'type', 'user_id'];

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');

    }
}

