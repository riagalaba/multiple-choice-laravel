<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Question;
use App\Test;

use App\Http\Requests\StoreChoiceRequest;

use Illuminate\Http\Request;

class ChoiceController extends Controller
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
     * List all choices of a given question ID
     */
    public function listByQuestion(Test $test, Question $question) 
    {
        $choices = Choice::where('question_id','=',$question->id)->get();

        return view('choice.list', ['test' => $test, 'question' => $question, 'choices' => $choices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Test $test, Question $question)
    {
        return view('choice.create', ['test' => $test, 'question' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Test $test, Question $question, StoreChoiceRequest $request)
    {
        $validated = $request->validated();

        $choice = new Choice;
        $choice->choice = $request->input('choice');
        $choice->answer = $request->input('answer') == 'on' ? 1 : 0;
        $choice->question_id = $question->id;
        $choice->save();
        
        return redirect('/admin/test/'.$test->id.'/question/'.$question->id.'/choice/create')->with(['status' => 'Successfully added a choice. Continue adding a new choice.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function show(Choice $choice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test, Question $question, Choice $choice)
    {
        return view('choice.edit', ['test' => $test, 'question' => $question,'choice' => $choice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreChoiceRequest $request, Test $test, Question $question, Choice $choice)
    {
        $validated = $request->validated();
        
        $choice->choice = $request->input('choice');
        $choice->answer = $request->input('answer') == 'on' ? 1 : 0;
        $choice->save();
        
        return redirect('/admin/test/'.$test->id.'/question/'.$question->id.'/choices')->with(['status' => 'Updated choice']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test, Question $question, Choice $choice)
    {
        $choice->delete();

        return redirect('/admin/test/'.$test->id.'/question/'.$question->id.'/choices')->with(['status' => 'Deleted choice']);
    }

}
