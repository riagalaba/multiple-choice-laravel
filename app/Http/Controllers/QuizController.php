<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
Use App\Choice;
use App\Test;

use Illuminate\Http\Request;

class QuizController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Get quiz items that includes questions and answers
     */
    protected function getItems($testId = 1) {
        $questions = $this->getQuestions($testId);
        $items = $this->loadItems($questions);
        return $items;
    }

    /**
     * Get quiz questions in a given test
     */
    protected function getQuestions($testId = 1) {
        $questions = \DB::table('questions')
                    ->where('test_id','=',$testId)
                    ->inRandomOrder()
                    ->get();
        return $questions;
    }


    /**
     * Load choices based on the given questions
     */
    protected function loadItems($questions) 
    {
        $items = array();

        foreach($questions as $question) {
            $choices = new Choice;
             $items[] = [
                'question' => $question,
                'choices' => $choices->getChoicesByQuestionId($question->id),
            ];
        }

        return $items;
    }

    /**
     * Check all submitted answers
     */
    public function checkQuiz(Test $test, Request $request) {
        $answers = $request->input('answers');
        $score = 0;
        $checkedAnswers = array();

        $questions = $this->getQuestions($test->id);
       
        foreach($questions as $question) {
            $correctAnswer = Choice::where('question_id','=',$question->id)->where('answer','=',1)->first();
            $answer = isset($answers[$question->id]) ? $answers[$question->id] : '';
            $checkedAnswers[$question->id] = [
                'choice' => $answer,
                'answer' => $correctAnswer->id,
            ];
            if($correctAnswer->id == $answer) { 
                $score++; 
                $checkedAnswers[$question->id]['result'] = 'correct';
            }
            else {
                $checkedAnswers[$question->id]['result'] = 'wrong';
            }
        }
        $items = $this->getItems($test->id);

        return view('quiz.grade', ['test' => $test, 'score' => $score, 'checkedAnswers' => $checkedAnswers, 'items' => $items]);
    }

    /**
     * show grade and test result
     */
    public function showGrade() {
        return view('quiz.grade');
    }

    public function listTests()
    {
        $tests = Test::all();       
        return view('quiz.listTests', ['tests' => $tests]);
    }

    /**
     * Take a quiz
     */
    public function takeTest(Test $test)
    {
        $items = $this->getItems($test->id);                   
        if(empty($items)) { return redirect('/quizzes'); }

        return view('quiz.takeTest', ['test' => $test, 'items' => $items]);
    }

}
