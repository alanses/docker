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

Route::get('/', 'Frontend\FrontendController@index')->name('frontend.index');
Route::get('/news', 'Frontend\FrontendController@showNews')->name('frontend.news');
Route::get('/about', 'Frontend\FrontendController@about')->name('frontend.about');
Route::get('/call-doctor', 'Frontend\FrontendController@callDoctorAtHome')->name('frontend.calldoctor');
Route::get('/record-doctor', 'Frontend\FrontendController@makeRecordToDoctor')->name('frontend.record');
Route::get('/services', 'Frontend\FrontendController@services')->name('frontend.services');

Route::get('/cabinet-user', 'Frontend\FrontendController@cabinetUser')
    ->middleware('auth', 'role.user')
    ->name('frontend.cabinet.user');
Route::get('/cabinet-doctor', 'Frontend\FrontendController@cabinetDoctor')
    ->middleware('auth', 'role.worker')
    ->name('frontend.cabinet.doctor');

Route::post('/save-call-doctor-at-home', 'Frontend\CallDoctorToHomeController@saveDoctorsCallAtHome');
Route::post('/change-setings', 'Frontend\UserCabinetController@changeSetings');
Route::post('/get-user-data', 'Frontend\UserCabinetController@getUserData');
Route::post('/change-setings-doctor', 'Frontend\DoctorCabinetController@changeSetings');

Route::post('/logout-user', 'Frontend\UserCabinetController@logOut');
Route::get('/logout', 'Frontend\FrontendController@logout');

Route::post('/get-my-registration-to-doctor-by-week', 'Frontend\UserCabinetController@getListRegistrationToDoctorWeek');
Route::post('/get-my-registration-to-doctor-by-month', 'Frontend\UserCabinetController@getListRegistrationToDoctorMonth');
Route::post('/search-doctors', 'Frontend\UserCabinetController@searchDoctors');
Route::post('/make-record-doctor', 'Frontend\UserCabinetController@makeRecordToDoctor');

Route::post('/get-schedule-week', 'Frontend\DoctorCabinetController@getScheduleWeek');
Route::post('/get-schedule-month', 'Frontend\DoctorCabinetController@getScheduleMonth');
Route::post('/get-info-doctor', 'Frontend\DoctorCabinetController@getInfoAboutDoctor');

Route::post('/save-new-reception', 'Frontend\DoctorCabinetController@saveNewReception');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role.admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('workers', 'WorkersController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('position-held', 'PositionHeldController');
    Route::resource('specializations', 'SpecializationController');
});

Route::post('/call-doctor-by-day', 'Admin\PatientsCallHomeController@callDoctorByDay');
Route::post('/call-doctor-by-week', 'Admin\PatientsCallHomeController@callDoctorByWeek');
Route::post('/call-doctor-by-month', 'Admin\PatientsCallHomeController@callDoctorByMonth');

Route::get('/talon/{id}', 'Frontend\FrontendController@generateTalon');
