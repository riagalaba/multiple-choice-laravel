@extends('layouts.app')
@section('pageTitle', 'List Choices')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Choices to Question: {{$question->question}}</div>
                <div class="card-body">
                    <div class="row" style="margin-bottom:10px">
                        <div class="col-md-2">
                            <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/choice/create" class="btn btn-info" role="button">Add</a>
                        </div>
                        <div class="col-md-2">
                            <a href="/admin/test/{{$test->id}}/questions" class="btn btn-info" role="button">Questions</a>
                        </div>
                    </div>
                    @if(Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status')}}</div>
                    @endif
                    @foreach ($choices as $choice)
                        @if ($loop->index % 2 == 0)
                            @php 
                                $rowColor = '#dbefff';
                            @endphp
                        @else 
                            @php 
                                $rowColor = '#ffffff';
                            @endphp
                        @endif
                        
                    <div class="row" style="background-color:{{ $rowColor }}; padding:5px;">
                        <div class="col-md-1">
                            <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/choice/{{ $choice->id }}/delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                        <div class="col-md-9">
                            <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/choice/{{ $choice->id }}/edit">{{$choice->choice}}</a>
                        </div>
                        <div class="col-md-2">
                            {{ $choice->answer == 1 ? 'Correct Answer' : '' }}</a>
                        </div>
                     </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
