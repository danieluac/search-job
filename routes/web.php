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
    Route::get('/job-details/{job_id}', "Company\JobsCtrl@seekerIndexJobsById")->name("seekerIndexJobsById");
    Route::get('/application-list/{job_id}', "Company\JobsCtrl@application_list")->name("application_list");

    Route::get('/create-job', "Company\JobsCtrl@createJobs")->name("create_jobs");
    Route::get('/update-job/{job_id}', "Company\JobsCtrl@editJobs")->name("edit_jobs");

    Route::get('/company-index-job', "Company\JobsCtrl@index")->name("indexed_jobs");
    Route::get('/job-my-application', "Company\JobsCtrl@my_job_application")->name("my_job_application");
    Route::get('/seeker-detail/{seeker_id}', "Company\JobsCtrl@seeker_cv")->name("seeker_cv");
    Route::get('/seeker-detail/{seeker_id}/{job_seeker_id?}', "Company\JobsCtrl@seeker_cv")->name("seeker_cv");
    Route::post('/select-seeker/{seeker_id}', "Company\JobsCtrl@select_seeker")->name("select_seeker");
    Route::post('/unselect-seeker/{seeker_id}', "Company\JobsCtrl@unselect_seeker")->name("unselect_seeker");


    Route::get('/company-close-job/{job_id}', "Company\JobsCtrl@fecharVaga")->name("close_jobs");
    Route::POST('/create-job', "Company\JobsCtrl@store")->name("store_jobs");
    Route::POST('/apply-job', "Company\JobsCtrl@apply_job")->name("apply_jobs");
    Route::POST('/update-job/{job_id}', "Company\JobsCtrl@update")->name("update_jobs");
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