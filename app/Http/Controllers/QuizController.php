<?php


namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizResult;
use App\Models\QuizSession;
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
            'answer' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        $user_id = auth()->id();

        QuizSession::updateOrCreate(
            ['user_id' => $user_id, 'question_id' => $request->question_id],
            ['answers' => $request->answer]
        );

        $nextQuestionIndex = $questionIndex + 1;

        if ($nextQuestionIndex < Question::count()) {
            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function viewResult()
    {
        $user_id = auth()->id();

        $answers = QuizSession::where('user_id', $user_id)->get();

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
            $stylePercentages[$style] = $totalAnswers > 0 ? ($score / $totalAnswers) * 100 : 0;
        }

        QuizResult::updateOrCreate(
            ['user_id' => $user_id],
            [
                'leader_percentage' => $stylePercentages['Leader'],
                'supporter_percentage' => $stylePercentages['Supporter'],
                'organizer_percentage' => $stylePercentages['Organizer'],
                'creative_percentage' => $stylePercentages['Creative'],
            ]
        );

        QuizSession::where('user_id', $user_id)->delete();

        return view('quiz_result', compact('stylePercentages'));
    }
}





//
//namespace App\Http\Controllers;
//
//use App\Models\Question;
//use App\Models\QuizResult;
//use App\Models\QuizSession;
//use App\Models\QuestionOption;
//use Illuminate\Http\Request;
//
//class QuizController extends Controller
//{
//    public function showQuiz($questionIndex = 0)
//    {
//
//        $questions = Question::with('options')->get();
//        $currentQuestion = $questions[$questionIndex] ?? null;
//
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
//            'answer' => 'required'
//        ]);
//
//        $answer = $request->input('answer');
//
//        $user_id = auth()->id();
//
//
//        $question = Question::with('options')->skip($questionIndex)->first();
//        if (!$question) {
//            return redirect()->route('quiz.result')->withErrors('Question not found.');
//        }
//
//        $question_id = $question->id;
//
//
//        QuizSession::updateOrCreate(
//            ['user_id' => $user_id, 'question_id' => $question_id],
//            ['answers' => $answer]
//        );
//
//        $nextQuestionIndex = $questionIndex + 1;
//
//
//        if ($nextQuestionIndex < Question::count()) {
//            return redirect()->route('quiz.show', ['questionIndex' => $nextQuestionIndex]);
//        } else {
//
//
//            $user = auth()->user();
////            $answers = QuizSession::where('user_id', $user_id)->with('selectedOption')->get();
////
////            $styleScores = [
////                'Leader' => 0,
////                'Supporter' => 0,
////                'Organizer' => 0,
////                'Creative' => 0,
////            ];
////
////            foreach ($answers as $answer) {
////                $style = $answer->selectedOption->style ?? null;
////                if ($style) {
////                    $styleScores[$style]++;
////                }
////            }
////
////            $totalAnswers = count($answers);
////            $stylePercentages = [];
////            foreach ($styleScores as $style => $score) {
////                $stylePercentages[$style] = ($totalAnswers > 0) ? ($score / $totalAnswers) * 100 : 0;
////            }
//////            $quizResults = QuizResult::findOrFail($user_id);
//////
//////            $quizResults->leader_percentage = $stylePercentages['Leader'];
//////            $quizResults->supporter_percentage = $stylePercentages['Supporter'];
//////            $quizResults->organizer_percentage = $stylePercentages['Organizer'];
//////            $quizResults->creative_percentage = $stylePercentages['Creative'];
//////
//////            $quizResults->save();
////
////            QuizResult::create([
////                'user_id' => $user_id, // Assign user_id directly
////                'leader_percentage' => $stylePercentages['Leader'],
////                'supporter_percentage' => $stylePercentages['Supporter'],
////                'organizer_percentage' => $stylePercentages['Organizer'],
////                'creative_percentage' => $stylePercentages['Creative'],
////            ]);
////
////
//////            return view('quiz_result', compact('stylePercentages'));
////
////            return view('quiz.result');
////
//////            return redirect()->route('welcome');
//        }
//
//    }
//
//    public function seeResult()
//    {
//        //return 1;
//        /*
//        $user = auth()->user();
//        $answers = QuizSession::where('user_id', $user->id)->with('selectedOption')->get();
//
//        $styleScores = [
//            'Leader' => 0,
//            'Supporter' => 0,
//            'Organizer' => 0,
//            'Creative' => 0,
//        ];
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
//            $stylePercentages[$style] = ($totalAnswers > 0) ? ($score / $totalAnswers) * 100 : 0;
//        }
//
//        QuizResult::updateOrCreate(
//            ['user_id' => $user->id],
//            [
//                'leader_percentage' => $stylePercentages['Leader'],
//                'supporter_percentage' => $stylePercentages['Supporter'],
//                'organizer_percentage' => $stylePercentages['Organizer'],
//                'creative_percentage' => $stylePercentages['Creative'],
//            ]
//        );
//
//        return view('quiz_result', compact('stylePercentages'));
//        */
//        // return view('welcome');
//    }
//
//    public function viewResult()
//    {
//
//        $user_id = auth()->user();
//
////        $quizResults = QuizResult::findOrFail($user_id);
////        return view('quiz_result', compact('quizResults'));
//
//        $answers = QuizSession::where('user_id', $user_id)->with('selectedOption')->get();
//
//        $styleScores = [
//            'Leader' => 0,
//            'Supporter' => 0,
//            'Organizer' => 0,
//            'Creative' => 0,
//        ];
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
//            $stylePercentages[$style] = ($totalAnswers > 0) ? ($score / $totalAnswers) * 100 : 0;
//        }
////            $quizResults = QuizResult::findOrFail($user_id);
////
////            $quizResults->leader_percentage = $stylePercentages['Leader'];
////            $quizResults->supporter_percentage = $stylePercentages['Supporter'];
////            $quizResults->organizer_percentage = $stylePercentages['Organizer'];
////            $quizResults->creative_percentage = $stylePercentages['Creative'];
////
////            $quizResults->save();
//
//        QuizResult::create([
//            'user_id' => $user_id,
//            'leader_percentage' => $stylePercentages['Leader'],
//            'supporter_percentage' => $stylePercentages['Supporter'],
//            'organizer_percentage' => $stylePercentages['Organizer'],
//            'creative_percentage' => $stylePercentages['Creative'],
//        ]);
//
//
//            return view('quiz_result', compact('stylePercentages'));
//
////        return view('quiz.result');
//
////            return redirect()->route('welcome');
//
//    }
//
//
//    public function showSavedResults()
//    {
//        $user = auth()->user();
//
//        $quizResult = QuizResult::where('user_id', $user->id)->first();
//
//        if ($quizResult) {
//            $stylePercentages = [
//                'Leader' => $quizResult->leader_percentage,
//                'Supporter' => $quizResult->supporter_percentage,
//                'Organizer' => $quizResult->organizer_percentage,
//                'Creative' => $quizResult->creative_percentage,
//            ];
//        } else {
//            $stylePercentages = null;
//        }
//
//        return view('quiz_myResult', compact('stylePercentages'));
//    }
//
//}
