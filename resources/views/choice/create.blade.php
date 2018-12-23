@extends('layouts.app')
@section('pageTitle', 'Create Choice')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create a choice for question: {{ $question->question }}</div>

                <div class="card-body">
                    <div class="row" style="margin-bottom:10px">
                        <div class="col-md-2">
                            <a href="/admin/test/{{$test->id}}/question/{{$question->id}}/choices" class="btn btn-info" role="button">Choices</a>
                        </div>
                        <div class="col-md-2">
                            <a href="/admin/test/{{$test->id}}/questions" class="btn btn-info" role="button">Questions</a>
                        </div>
                    </div>
                    @if(Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status')}}</div>
                    @endif
                    <form method="POST" action="/admin/test/{{$test->id}}/question/{{$question->id}}/choice/create">
                        @csrf

                        <div class="form-group row">
                            <label for="choice" class="col-md-2 col-form-label text-md-right">{{ __('Choice') }}</label>

                            <div class="col-md-10">
                                <input id="choice" type="text" class="form-control{{ $errors->has('choice') ? ' is-invalid' : '' }}" name="choice" value="{{ old('choice') }}" required autofocus>

                                @if ($errors->has('choice'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('choice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="answer" id="answer" {{ old('answer') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="answer">
                                        {{ __('Correct Answer') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save and Add New') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
