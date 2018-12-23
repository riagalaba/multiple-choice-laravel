@extends('layouts.app')
@section('pageTitle', 'Quiz')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quiz: {{$test->name}}</div>

                <div class="card-body">
                    <div class="row" style="margin-bottom:10px">
                        <div class="col-md-2">
                            <a href="/quizzes" class="btn btn-info" role="button">List Quizzes</a>
                        </div>
                    </div>
                    <form method="POST" action="/quiz/{{$test->id}}">
                        @csrf
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
                                        @foreach ($item['choices'] as $choice)
                                            <li><input type="radio" name="answers[{{$item['question']->id}}]" id="choice_{{$choice->id}}" value="{{$choice->id}}" style="margin-left:5px;" /> <label for="choice_{{$choice->id}}" style="margin-left:10px;">{{ $choice->choice }}</label></li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row" style="margin-top:10px;">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
