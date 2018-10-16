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

Route::post('/create_team', 'WorkProcessController@createTeam')->name('create_team');
Route::post('/create_employer', 'WorkProcessController@createEmployer')->name('create_employer');

Route::post('/work_list', 'WorkProcessController@workInThisTeamInThisDay')->name('work_list');

Route::post('/add_work_hours_to_employer', 'WorkProcessController@addNewWorkingHours')->name('add_work_hours_to_employer');

Route::get('/get_all_working_data', 'WorkProcessController@getAllWorkingData')->name('get_all_working_data');

