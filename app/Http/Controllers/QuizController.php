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

        $totalQuestions = $questions->count();
        $progress = ($questionIndex / $totalQuestions) * 100;

        return view('quiz.quiz', compact('currentQuestion', 'questionIndex', 'questions', 'progress'));
    }

    public function saveAnswer(Request $request, $questionIndex)
    {
        $request->validate([
            'answer' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        $user_id = auth()->id();

        // Assuming you also want to save the points when saving the answer
        $answer = $request->answer;
        $stylePoints = $this->getStylePoints($answer); // This function calculates points

        QuizData::updateOrCreate(
            ['user_id' => $user_id, 'question_id' => $request->question_id],
            ['answer' => $answer, 'leader_percentage' => $stylePoints['Leader'], 'supporter_percentage' => $stylePoints['Supporter']]
        );

        // Log to check if data is correct
        Log::info('Answer saved:', ['user_id' => $user_id, 'answer' => $answer, 'stylePoints' => $stylePoints]);

        $nextQuestionIndex = $questionIndex + 1;

        if ($nextQuestionIndex < Question::count()) {
            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
        }

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











//namespace App\Http\Controllers;
//
//use App\Models\Question;
//use App\Models\QuizResult;
//use App\Models\QuizSession;
//use Illuminate\Http\Request;
//
//class QuizController extends Controller
//{
//    public function showQuiz($questionIndex = 0)
//    {
//        $questions = Question::with('options')->get();
//
//        $currentQuestion = $questions[$questionIndex] ?? null;
//
//        if (!$currentQuestion) {
//            return redirect()->route('quiz.result');
//        }
//
//        return view('quiz.quiz', compact('currentQuestion', 'questionIndex', 'questions'));
//    }
//
//    public function saveAnswer(Request $request, $questionIndex)
//    {
//        $request->validate([
//            'answer' => 'required',
//            'question_id' => 'required|exists:questions,id',
//        ]);
//
//        $user_id = auth()->id();
//
//        QuizSession::updateOrCreate(
//            ['user_id' => $user_id, 'question_id' => $request->question_id],
//            ['answers' => $request->answer]
//        );
//
//        $nextQuestionIndex = $questionIndex + 1;
//
//        if ($nextQuestionIndex < Question::count()) {
//            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
//        } else {
//            return redirect()->route('dashboard');
//        }
//    }
//
//    public function viewResult()
//    {
//        $user_id = auth()->id();
//
//        $answers = QuizSession::where('user_id', $user_id)->get();
//
//        $styleScores = [
//            'Leader' => 0,
//            'Supporter' => 0,
//            'Organizer' => 0,
//            'Creative' => 0,
//        ];
//
//
//        foreach ($answers as $answer) {
//            $style = $answer->selectedOption->style ?? null;
//            if ($style) {
//                $styleScores[$style]++;
//            }
//        }
//
//        $totalAnswers = count($answers);
//        $stylePercentages = [];
//        foreach ($styleScores as $style => $score) {
//            $stylePercentages[$style] = $totalAnswers > 0 ? ($score / $totalAnswers) * 100 : 0;
//        }
//
//        QuizResult::updateOrCreate(
//            ['user_id' => $user_id],
//            [
//                'leader_percentage' => $stylePercentages['Leader'],
//                'supporter_percentage' => $stylePercentages['Supporter'],
//                'organizer_percentage' => $stylePercentages['Organizer'],
//                'creative_percentage' => $stylePercentages['Creative'],
//            ]
//        );
//
//        QuizSession::where('user_id', $user_id)->delete();
//
//        return view('quiz_result', compact('stylePercentages'));
//    }
//}

