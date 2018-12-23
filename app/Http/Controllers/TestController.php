<?php

namespace App\Http\Controllers;

use App\Test;

use App\Http\Requests\StoreTestRequest;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();
        return view('test.list', ['tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request)
    {
        $validated = $request->validated();

        $test = new Test;
        $test->name = $request->input('name');
        $test->save();      

        return redirect('/admin/test/'.$test->id.'/question/create')->with(['status' => 'Successfully added a new test. Start adding questions now.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('test.edit', ['test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTestRequest $request, Test $test)
    {
        $validated = $request->validated();

        $test->name = $request->input('name');
        $test->update();
        
        $alertClass = 'alert-success';

        return redirect('/admin/tests')->with(['status' => 'Updated test name', 'alertClass' => $alertClass]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $result = '';
        try {
            $test->delete();
            $status = 'Deleted Test';
            $alertClass = 'alert-success';
        }
        catch (\Exception $e) {
            $status = 'You need to delete the questions first.';
            $alertClass = 'alert-danger';
        }

        return redirect('/admin/tests')->with(['status' => $status, 'alertClass' => $alertClass]);
    }
}
