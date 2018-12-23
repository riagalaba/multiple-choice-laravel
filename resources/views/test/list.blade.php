@extends('layouts.app')
@section('pageTitle', 'List Tests')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tests</div>

                <div class="card-body">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-12">
                            <a href="/admin/test/create" class="btn btn-info" role="button">Add</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <em>You can only delete empty tests.</em>
                        </div>
                    </div>
                    @if(Session::has('status'))
                        <div class="alert {{ Session::get('alertClass') }}">{{ Session::get('status')}}</div>
                    @endif
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
                            <div class="col-md-1">
                                <a href="/admin/test/{{$test->id}}/questions">View</a>
                            </div>
                            <div class="col-md-1">
                                <a href="/admin/test/{{$test->id}}/delete" onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
                            <div class="col-md-10">
                                <a href="/admin/test/{{$test->id}}/edit">{{$test->name}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
