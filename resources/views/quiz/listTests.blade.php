@extends('layouts.app')
@section('pageTitle', 'Quizzes')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quizzes</div>

                <div class="card-body">
                    @foreach ($tests as $test)
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
                                <a href="/quiz/{{$test->id}}">{{$test->name}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
