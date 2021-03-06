@extends('layouts.app')
@section('pageTitle', 'Create Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Question for {{$test->name}}</div>

                <div class="card-body">
                    <div class="row" style="margin-bottom:10px">
                        <div class="col-md-2">
                            <a href="/admin/test/{{$test->id}}/questions" class="btn btn-info" role="button">Questions</a>
                        </div>
                        <div class="col-md-2">
                            <a href="/admin/tests" class="btn btn-info" role="button">Tests</a>
                        </div>
                    </div>
                    @if(Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status')}}</div>
                    @endif
                    <form method="POST" action="/admin/test/{{$test->id}}/question/create">
                        @csrf

                        <div class="form-group row">
                            <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('name') }}" required autofocus="autofocus">

                                @if ($errors->has('question'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save and Add Choices') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
