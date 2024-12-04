<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizResult;
use App\Models\QuizSession;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showQuiz($questionIndex = 0)
    {

        $questions = Question::with('options')->get();
        $currentQuestion = $questions[$questionIndex] ?? null;


        if (!$currentQuestion) {
            return redirect()->route('quiz.result');
        }

        return view('quiz.quiz', compact('currentQuestion', 'questionIndex', 'questions'));
    }

    public function saveAnswer(Request $request, $questionIndex)
    {
        $request->validate([
            'answer' => 'required'
        ]);

        $answer = $request->input('answer');

        $user_id = auth()->id();


        $question = Question::with('options')->skip($questionIndex)->first();
        if (!$question) {
            return redirect()->route('quiz.result')->withErrors('Question not found.');
        }

        $question_id = $question->id;


        QuizSession::updateOrCreate(
            ['user_id' => $user_id, 'question_id' => $question_id],
            ['answer' => $answer]
        );

        $nextQuestionIndex = $questionIndex + 1;

        if ($nextQuestionIndex < Question::count()) {
            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
        } else {
            return Question::count();
            return redirect()->route('quiz.result');
        }
    }

    public function seeResult(Request $request)
    {
        $user = auth()->user();
        $answers = QuizSession::where('user_id', $user->id)->with('selectedOption')->get();

        $styleScores = [
            'Leader' => 0,
            'Supporter' => 0,
            'Organizer' => 0,
            'Creative' => 0,
        ];

        foreach ($answers as $answer) {
            $style = $answer->selectedOption->style ?? null;
            if ($style) {
                $styleScores[$style]++;
            }
        }

        $totalAnswers = count($answers);
        $stylePercentages = [];
        foreach ($styleScores as $style => $score) {
            $stylePercentages[$style] = ($totalAnswers > 0) ? ($score / $totalAnswers) * 100 : 0;
        }

        QuizResult::updateOrCreate(
            ['user_id' => $user->id],
            [
                'leader_percentage' => $stylePercentages['Leader'],
                'supporter_percentage' => $stylePercentages['Supporter'],
                'organizer_percentage' => $stylePercentages['Organizer'],
                'creative_percentage' => $stylePercentages['Creative'],
            ]
        );

        return view('quiz_result', compact('stylePercentages'));
    }


}
