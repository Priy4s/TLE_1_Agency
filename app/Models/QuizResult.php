<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    // Define the table name if it's not the plural of the model name
    protected $table = 'quiz_results';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'leader_percentage',
        'supporter_percentage',
        'organizer_percentage',
        'creative_percentage',
    ];
}
