@extends('layouts.app')
@section('pageTitle', 'List Questions')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Questions in {{$test->name}}</div>

                <div class="card-body">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-1">
                            <a href="/admin/test/{{$test->id}}/question/create" class="btn btn-info" role="button">Add</a>
                        </div>
                        <div class="col-md-1">
                            <a href="/admin/tests" class="btn btn-info" role="button">Tests</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <em>Deleting a question will delete all the choices associated with it.</em>
                        </div>
                    </div>
                    @if(Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status')}}</div>
                    @endif
                    @foreach ($questions as $question)
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
                            <div class="col-md-1">
                                <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/choices">Choices</a>
                            </div>
                            <div class="col-md-1">
                                <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/delete" onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
                            <div class="col-md-10">
                                {{$loop->index + 1}}. <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/edit">{{$question->question}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
