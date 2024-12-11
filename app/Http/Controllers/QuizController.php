<?php
namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function startQuiz()
    {
        $user_id = auth()->id();
        QuizData::where('user_id', $user_id)->delete();

        return redirect()->route('quiz.show', ['questionIndex' => 0]);
    }

    public function showQuiz($questionIndex = 0)
    {
        $questions = Question::with('options')->get();
        $currentQuestion = $questions[$questionIndex] ?? null;

        if (!$currentQuestion) {
            return redirect()->route('quiz.result');
        }

        $user_id = auth()->id();

        $savedAnswer = QuizData::where('user_id', $user_id)
            ->where('question_id', $currentQuestion->id)
            ->value('answer');

        //        $previousQuestionIndex = $questionIndex > 0 ? $questionIndex - 1 : null;

        $totalQuestions = $questions->count();
        $progress = (($questionIndex + 1) / $totalQuestions) * 100;

        return view('quiz.quiz', compact(
            'currentQuestion', 'questionIndex', 'questions', 'progress', 'savedAnswer'));
    }

    public function saveAnswer(Request $request, $questionIndex)
    {
        $request->validate([
            'answer' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        $user_id = auth()->id();
        $answer = $request->answer;

        // Save or update the user's answer
        QuizData::updateOrCreate(
            ['user_id' => $user_id, 'question_id' => $request->question_id],
            ['answer' => $answer]
        );

        $nextQuestionIndex = $questionIndex + 1;

        if ($nextQuestionIndex < Question::count()) {
            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
        }

//
//        $previousQuestionIndex = $questionIndex > 0 ? $questionIndex - 1 : null;
//
//        if ($previousQuestionIndex) {
//            return redirect()->route('quiz.show', ['questionIndex' => $previousQuestionIndex]);
//        }

        return redirect()->route('quiz.result');
    }


    private function getStylePoints($answer)
    {
        // Initialize points for each style
        $points = ['Leader' => 0, 'Supporter' => 0, 'Organizer' => 0, 'Creative' => 0];

        // Example logic for assigning points based on answer
        switch ($answer) {
            case 1:
                $points['Leader'] = 1;
                break;
            case 2:
                $points['Supporter'] = 1;
                break;
            // Add more cases as needed based on the mapping
            // For instance, if the answer corresponds to Creative or Organizer
        }

        return $points;
    }

    public function viewResult()
    {
        $user_id = auth()->id();

        // Fetch the user's answers
        $answers = QuizData::where('user_id', $user_id)->get();

        // Initialize scores
        $styleScores = [
            'Leader' => 0,
            'Supporter' => 0,
            'Organizer' => 0,
            'Creative' => 0,
        ];

        // Map options to styles
        $styleMapping = [
            1 => ['Observer' => 'Creative', 'Organizer' => 'Organizer', 'Supporter' => 'Supporter', 'Leader' => 'Leader'],
            2 => ['Logical and analytical' => 'Leader', 'Creative and out-of-the-box' => 'Creative', 'Step-by-step and methodical' => 'Organizer', 'Collaborative and with group input' => 'Supporter'],
            3 => ['Learning new skills' => 'Creative', 'Recognition for achievements' => 'Leader', 'Completing tasks efficiently' => 'Organizer', 'Supporting and helping others succeed' => 'Supporter'],
            4 => ['Organized' => 'Organizer', 'Empathetic' => 'Supporter', 'Strategic' => 'Leader', 'Creative' => 'Creative'],
            5 => ['Brainstorming new ideas' => 'Creative', 'Planning and scheduling' => 'Organizer', 'Helping teammates' => 'Supporter', 'Completing tasks independently' => 'Leader'],
            6 => ['Clear communication' => 'Organizer', 'Offering emotional support' => 'Supporter', 'Mediating conflicts' => 'Creative', 'Delegating tasks' => 'Leader'],
        ];

        foreach ($answers as $answer) {
            $questionId = $answer->question_id;
            $option = $answer->selectedOption->option ?? null;

            // Assign points based on mapping
            if (isset($styleMapping[$questionId][$option])) {
                $style = $styleMapping[$questionId][$option];
                $styleScores[$style]++;
            }

            // Handle Likert scale questions
            if ($questionId >= 7 && $questionId <= 10) {
                $score = intval($answer->selectedOption->option); // Likert option is 1-5
                switch ($questionId) {
                    case 7:
                        $styleScores['Leader'] += $score;
                        break;
                    case 8:
                        $styleScores['Organizer'] += $score;
                        break;
                    case 9:
                        $styleScores['Creative'] += $score;
                        break;
                    case 10:
                        $styleScores['Supporter'] += $score;
                        break;
                }
            }
        }

        // Calculate percentages
        $totalPoints = array_sum($styleScores);
        $stylePercentages = [];
        foreach ($styleScores as $style => $score) {
            $stylePercentages[$style] = $totalPoints > 0 ? round(($score / $totalPoints) * 100) : 0;
        }

        // Pass data to the view
        return view('quiz.quiz_result', compact('stylePercentages'));
    }
}
