<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizSession;
use Illuminate\Http\Request;
use App\Models\QuestionOption;

class QuizController extends Controller
{
    public function showQuiz($questionIndex = 0)
    {
        $questions = Question::with('options')->get();
        $currentQuestion = $questions[$questionIndex] ?? null;
        return view('quiz.quiz', compact('currentQuestion', 'questionIndex', 'questions'));
    }

    public function saveAnswer(Request $request, $questionIndex)
    {
        $request->validate([
            'answer' => 'required'
        ]);

        $answer = $request->input('answer');

        // Save the user's answer to the QuizSession table
        $user_id = auth()->id(); // Assuming user is logged in
        $question_id = Question::skip($questionIndex)->first()->id; // Get the current question's ID

        QuizSession::updateOrCreate(
            ['user_id' => $user_id, 'question_id' => $question_id],
            ['answer' => $answer]
        );

        $nextQuestionIndex = $questionIndex + 1;

        // Redirect to the next question or to the result page
        if ($nextQuestionIndex < Question::count()) {
            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
        } else {
            return redirect()->route('quiz.result');
        }
    }


    public function showResult(Request $request)
    {
        $user = auth()->user(); // Assuming the user is logged in
        $answers = QuizSession::where('user_id', $user->id)
            ->with('question') // Assuming you have a relationship between QuizSession and Question
            ->get();

        // Initialize counts for each style (example: Leadership, Teamwork, etc.)
        $styleScores = [
            'Leader' => 0,
            'Supporter' => 0,
            'Organizer' => 0,
            'Creative' => 0,
            // Add more styles as needed
        ];

        // Calculate scores based on the answers
        foreach ($answers as $answer) {
            $question = $answer->question;
            $userAnswer = $answer->answer;

            switch ($question->id) {
                case 1: // Question 1: What role do you naturally take in a team?
                    // Increase score based on the selected answer (assuming the options are mapped to styles)
                    if ($userAnswer == 'Leader') {
                        $styleScores['Leader']++;
                    } elseif ($userAnswer == 'Supporter') {
                        $styleScores['Supporter']++;
                    }
                    break;

                case 2: // Question 2: How do you prefer to approach problem-solving?
                    if ($userAnswer == 'Creative and out-of-the-box') {
                        $styleScores['Creative']++;
                    }
                    break;

                // Add more cases based on your questions and logic
                // You will need to add logic for all your questions here
            }
        }

        // Calculate the percentages for each style
        $totalQuestions = count($answers); // Total number of answered questions
        $stylePercentages = [];
        foreach ($styleScores as $style => $score) {
            $stylePercentages[$style] = ($score / $totalQuestions) * 100;
        }

        // Pass the results to the view
        return view('quiz_result', compact('stylePercentages'));
    }
}
