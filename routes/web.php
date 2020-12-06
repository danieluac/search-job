<?php

use Illuminate\Support\Facades\Route;

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



Route::group([
    // 'middleware' => ['guest'],
    // 'namespace' => 'Fornecedor',
    'prefix' => 'job'
],function(){
    Route::get('/search-for-job', "Company\JobsCtrl@findJobs")->name("find_jobs");
});
Route::group([
    'middleware' => ['guest'],
    'namespace' => 'Auth',
    // 'prefix' => 'job'
],function(){
    Route::get('/company-registration', "RegisterController@showCompanyRegistrationForm")->name("company_registration");
});

Route::group([
     'middleware' => ['auth'],
     'namespace' => 'Seekers',
    'prefix' => 'seekers'
],function(){

Route::get('/profile', "SeekersCtrl@profile")->name("profile");

Route::get('/qualifications/create', "QualificationsCtrl@create")->name("qualifications_create");
Route::Post('/qualifications/store', "QualificationsCtrl@store")->name("qualifications_store");
Route::get('/qualifications/edit/{id}', "QualificationsCtrl@edit")->name("qualifications_edit");
Route::PUT('/qualifications/update/{id}', "QualificationsCtrl@update")->name("qualifications_update");
Route::POST('/qualifications/destroy/{id}', "QualificationsCtrl@destroy")->name("qualifications_destroy");

Route::get('/skills/create', "SkillsCtrl@create")->name("skills_create");
Route::Post('/skills/store', "SkillsCtrl@store")->name("skills_store");
Route::get('/skills/edit/{id}', "SkillsCtrl@edit")->name("skills_edit");
Route::PUT('/skills/update/{id}', "SkillsCtrl@update")->name("skills_update");
Route::POST('/skills/destroy/{id}', "SkillsCtrl@destroy")->name("skills_destroy");

Route::get('/expirience/create', "ExpiriencesCtrl@create")->name("expirience_create");
Route::Post('/expirience/store', "ExpiriencesCtrl@store")->name("expirience_store");
Route::get('/expirience/edit/{id}', "ExpiriencesCtrl@edit")->name("expirience_edit");
Route::PUT('/expirience/update/{id}', "ExpiriencesCtrl@update")->name("expirience_update");
Route::POST('/expirience/destroy/{id}', "ExpiriencesCtrl@destroy")->name("expirience_destroy");

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');