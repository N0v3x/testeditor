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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test/create', 'TestController@showSubjects')->name('create');
Route::post('/test/create/topic','TopicsController@createTopic')->name('createTopic');
Route::get('/test/create/topic/{id}','QuestionsController@addQuestion')->name('addQuestion');
Route::get('/test/edit/','TestController@showSubject')->name('showSubject');
Route::post('/test/edit/{id}','TopicsController@deleteTopic');
Route::post('/test/edit/show/{id}','TopicsController@showTopics');
Route::get('/test/edit/show/questions/{id}','QuestionsController@showQuestions');
Route::post('/topic/edit/{id}','TopicsController@changeTopic');
Route::post('/question/delete/{id}','QuestionsController@deleteQuestion');
Route::get('/test/question/edit/{id_topic}/{id_question}','QuestionsController@getQuestion');
Route::post('/question/edit/{id}','QuestionsController@editQuestion');


