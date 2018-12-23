<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;

use App\Http\Requests\StoreQuestionRequest;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.list', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Test $test)
    {
        return view('question.create', ['test' => $test]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request, Test $test)
    {
        $validated = $request->validated();

        $question = new Question;
        $question->question = $request->input('question');
        $question->test_id = $test->id;
        $question->save();        

        return redirect('/admin/test/'.$test->id.'/question/'.$question->id.'/choice/create')->with(['status' => 'Successfully added the question. Start adding choices now.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('question.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test, Question $question)
    {
        return view('question.edit', ['test' => $test, 'question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, Test $test, Question $question)
    {
        $validated = $request->validated(); 
        
        $question->question = $request->input('question');
        $question->update();

        return redirect('/admin/test/'.$test->id.'/questions')->with(['status' => 'Updated question']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test, Question $question)
    {
        $question->delete();

        return redirect('/admin/test/'.$test->id.'/questions')->with(['status' => 'Deleted question']);
    }

    public function list(Test $test) {
        $questions = Question::where('test_id','=',$test->id)->get();
        return view('question.list', ['test' => $test, 'questions' => $questions]);
    }
}
