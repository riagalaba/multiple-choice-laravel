@extends('layouts.app')
@section('pageTitle', 'Quiz Result')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quiz Result</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <h2>Your score: {{ $score }} / {{ count($items) }}</h2>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-2">
                            <a href="/quiz/{{$test->id}}" class="btn btn-info" role="button">Take the quiz again</a>
                        </div>
                        <div class="col-md-2">
                            <a href="/quizzes" class="btn btn-info" role="button">List Quizzes</a>
                        </div>
                    </div>

                    @foreach ($items as $item)
                        @if ($loop->index % 2 == 0)
                            @php 
                                $rowColor = '#dbefff';
                            @endphp
                        @else 
                            @php 
                                $rowColor = '#ffffff';
                            @endphp
                        @endif
                        <div class="row" style="background-color:{{$rowColor}}; padding: 5px;">
                            <div class="col-md-10">
                                {{ $loop->index + 1 }}. <strong>{{$item['question']->question}}</strong>
                            </div>
                        </div>
                        <div class="row" style="background-color:{{$rowColor}}; padding: 5px;">
                            <div class="col-md-10">
                                <ol type="A">
                                    @php
                                        $style = '';
                                        if($checkedAnswers[$item['question']->id]['result'] == 'correct') {
                                            $liColor = '#adffad';  
                                            $spanResultColor = 'green';                                              
                                        }
                                        else {
                                            $liColor = '#f9aec9';
                                            $spanResultColor = 'red';                                              
                                        }
                                        if(isset($liColor)) {
                                            $style = 'background-color:'.$liColor;
                                        }
                                    @endphp
                                    @foreach ($item['choices'] as $choice)
                                        <li style="{{ $choice->id ==  $checkedAnswers[$item['question']->id]['choice'] ? $style : ''}}"><label for="choice_{{$choice->id}}" style="margin-left:10px;">{{ $choice->choice }} &nbsp;&nbsp;&nbsp;<em><strong> {{$checkedAnswers[$item['question']->id]['answer'] == $choice->id ? '→ Correct answer' : ''}}</strong></em></label></li>
                                    @endforeach
                                </ol>
                                @if (!empty($checkedAnswers[$item['question']->id]['choice']))
                                    <span style="color: {{$spanResultColor}}">Your answer is <strong>{{ $checkedAnswers[$item['question']->id]['result']}}.</strong></span>
                                @else 
                                    <span style="color: {{$spanResultColor}}"><strong>You have no answer.</strong></span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
