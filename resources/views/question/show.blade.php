@extends('layouts.app')
@section('pageTitle', 'List Questions')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Questions</div>

                <div class="card-body">
                {{$question}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
