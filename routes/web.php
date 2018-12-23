<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::redirect('/home', '/');

/** The routes below are for public access */
// Quiz 
Route::get('/quizzes', 'QuizController@listTests'); // list all tests
Route::get('/quiz/{test}', 'QuizController@takeTest'); // list all questions in a test
Route::post('/quiz/{test}', 'QuizController@checkQuiz'); // check a given test
Route::get('/quiz/grade', 'QuizController@showGrade'); // show grade


/** The routes below need user authentication */
// Tests
Route::get('/admin/tests', 'TestController@index')->middleware('auth');

Route::get('/admin/test/create', 'TestController@create')->middleware('auth');
Route::post('/admin/test/create', 'TestController@store')->middleware('auth');

Route::get('/admin/test/{test}/edit', 'TestController@edit')->middleware('auth');
Route::put('/admin/test/{test}/edit', 'TestController@update')->middleware('auth');

Route::get('/admin/test/{test}/delete', 'TestController@destroy')->middleware('auth');

// Questions
Route::get('/admin/test/{test}/questions', 'QuestionController@list');
Route::get('/admin/test/{test}/question/create', 'QuestionController@create')->middleware('auth');
Route::post('/admin/test/{test}/question/create', 'QuestionController@store')->middleware('auth');

Route::get('/admin/test/{test}/question/{question}/edit', 'QuestionController@edit')->middleware('auth');
Route::put('/admin/test/{test}/question/{question}/edit', 'QuestionController@update')->middleware('auth');

Route::get('/admin/test/{test}/question/{question}/delete', 'QuestionController@destroy')->middleware('auth');

// Choices
Route::get('/admin/test/{test}/question/{question}/choices', 'ChoiceController@listByQuestion')->middleware('auth');

Route::get('/admin/test/{test}/question/{question}/choice/create', 'ChoiceController@create')->middleware('auth');
Route::post('/admin/test/{test}/question/{question}/choice/create', 'ChoiceController@store')->middleware('auth');

Route::get('/admin/test/{test}/question/{question}/choice/{choice}/edit', 'ChoiceController@edit')->middleware('auth');
Route::put('/admin/test/{test}/question/{question}/choice/{choice}/edit', 'ChoiceController@update')->middleware('auth');

Route::get('/admin/test/{test}/question/{question}/choice/{choice}/delete', 'ChoiceController@destroy')->middleware('auth');


