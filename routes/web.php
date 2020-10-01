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

Route::get('/', ['as' => 'site.index', 'uses' => 'SiteController@index']);
Route::post('saveuser', ['as' => 'site.saveuser', 'uses' => 'SiteController@saveuser']);
Route::post('site/store', ['as' => 'site.store', 'uses' => 'SiteController@store']);
Route::get('site/final', ['as' => 'site.final', 'uses' => 'SiteController@final']);

Route::post('targetjob/store', ['as' => 'targetjob.store', 'uses' => 'TargetJobController@store']);
Route::delete('targetjob/{id}', ['as' => 'targetjob.destroy', 'uses' => 'TargetJobController@destroy']);

Route::get('teste', ['as' => 'site.teste', 'uses' => 'SiteController@teste']);

Route::resource('industry', 'IndustryController');
Route::resource('occupation_area', 'OccupationAreaController');
Route::resource('training_degree', 'TrainingDegreeController');


Route::post('formation/store', ['as' => 'formation.store', 'uses' => 'FormationController@store']);
Route::delete('formation/{id}', ['as' => 'formation.destroy', 'uses' => 'FormationController@destroy']);

Route::get('experience/show', ['as' => 'experience.show', 'uses' => 'ProfessionalExperienceController@show']);
Route::post('experience/store', ['as' => 'experience.store', 'uses' => 'ProfessionalExperienceController@store']);
Route::delete('experience/{id}', ['as' => 'experience.destroy', 'uses' => 'ProfessionalExperienceController@destroy']);

Route::get('login', [ 'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login/entrar', [ 'as' => 'login.entrar', 'uses' => 'LoginController@entrar']);
Route::get('login/sair', [ 'as' => 'login.sair', 'uses' => 'LoginController@sair']);

Route::resource('rating', 'RatingController');
