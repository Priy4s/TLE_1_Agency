<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizData extends Model
{
    use HasFactory;

    protected $table = 'quiz_data';

    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
        'leader_percentage',
        'supporter_percentage',
        'organizer_percentage',
        'creative_percentage',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'answer', 'id');
    }
}
