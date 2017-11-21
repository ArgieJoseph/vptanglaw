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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/chuchu','Controller@getDataChuchu');

//USER CONTROLLER
Route::GET('/admin/home','AdminController@index');
Route::get('/director','DirectorController@index');
Route::get('/registrar','RegistrarController@index');
Route::get('/ipo','IPOController@index');
Route::get('/vp','VPController@index');

//USER PROFILE
Route::GET('/profile','AdminProfileController@profiles')->name('profile');

Route::Post('/profile','AdminProfileController@updateavatar');

//USEr MANGEMENT
Route::get('/admin_user_management','AdminUserManagementController@index')->name('admin_um');
Route::post('addUser','AdminUserManagementController@myformPost');
Route::get('editUser','AdminUserManagementController@edit');
Route::post('updateUser','AdminUserManagementController@update');
Route::get('/editUserStatus','AdminUserManagementController@editStatus');
Route::post('updateUserStatus','AdminUserManagementController@updateStatus');

//ADMIN LOGIN SYSTEM ROUTES


Route::GET('admin/test','RegistrarController@test');

Route::GET('/registrar','RegistrarController@index');    


Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');

Route::POST('admin','Admin\LoginController@login');

Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


//ADMIN ROUTES



// VP ROUTES
Route::get('/vp_enrollment', 'VPPagesController@vp_enrollment')->name('vp_enrol');
Route::get('/vp_enrollment_pdf', 'VPPagesController@vp_enrollment_pdf')->name('vp_enrol_pdf');
Route::get('/vp_graduates', 'VPPagesController@vp_graduates')->name('vp_grad');
Route::get('/vp_scholarship', 'VPPagesController@vp_scholarship')->name('vp_scho');
Route::get('/vp_licensure', 'VPPagesController@vp_licensure')->name('vp_lin');
Route::get('/vp_faculty', 'VPPagesController@vp_faculty')->name('vp_facu');
Route::get('/vp_administrative', 'VPPagesController@vp_administrative')->name('vp_admin');
Route::get('/vp_finance', 'VPPagesController@vp_finance')->name('vp_fin');
Route::get('/vp_facility', 'VPPagesController@vp_facility')->name('vp_faci');
Route::get('/vp_appendices', 'VPPagesController@vp_appendices')->name('vp_app');
Route::get('/vp_index', 'VPPagesController@vp_index')->name('vp_index');

//Tables

Route::get('/admin_campus','AdminCampusController@index');
Route::post('/table','AdminCampusController@create');
Route::get('/admin_campus_table','AdminCampusController@read');
Route::post('/','AdminCampusController@delete');
Route::get('/edit','AdminCampusController@edit');
Route::post('/update','AdminCampusController@update');
Route::get('/get_data_search','AdminCampusController@get_data_search');
Route::get('/search','AdminCampusController@search');

//AddSem
Route::post('addSemester','AdminSemesterController@create');
Route::get('/searchsem','AdminSemesterController@search');
Route::get('/admin_semester','AdminSemesterController@index')->name('admin_sem');
Route::get('/editSemester','AdminSemesterController@edit');
Route::post('/updateSemester','AdminSemesterController@update');
Route::post('/updateSemesterStatus','AdminSemesterController@updateStatus');
Route::get('/editSemesterStatus','AdminSemesterController@editStatus');
Route::post('/deleteSemester','AdminSemesterController@delete');
Route::get('/admin_schoolyear','AdminSchoolYearController@index')->name('admin_sy');
Route::post('/addSchoolYear','AdminSchoolYearController@create');
Route::post('/deleteYear','AdminSchoolYearController@delete');
Route::get('/editSchoolYearStatus','AdminSchoolYearController@editStatus');
Route::post('/updateSchoolYearStatus','AdminSchoolYearController@updateStatus');
Route::get('/editSchoolYear','AdminSchoolYearController@edit');
Route::post('/updateSchoolYear','AdminSchoolYearController@update');

Route::Get('/excel','ExcelController@export');
Route::get('/upload','ExcelController@upload');
Route::POST('/import','ExcelController@import');

Route::get('/admin_program_advance','AdminAdvanceProgramController@index')->name('admin_adv');
Route::post('addAdvanceProgram','AdminAdvanceProgramController@create');
Route::post('/deleteAdvanced','AdminAdvanceProgramController@delete');
Route::get('editAdvanceProgram','AdminAdvanceProgramController@edit');
Route::post('updateAdvance','AdminAdvanceProgramController@update');
Route::get('/admin_program_higher','AdminHigherEducationController@index')->name('admin_high');
Route::post('addHigherEducation','AdminHigherEducationController@create');
Route::get('editHigherEducation','AdminHigherEducationController@edit');
Route::post('updateHigher','AdminHigherEducationController@update');
Route::post('deleteHigher','AdminHigherEducationController@delete');
Route::get('/admin_program_technical','AdminTechnicalProgramController@index')->name('admin_tech');
Route::post('addTechnicalProgram','AdminTechnicalProgramController@create');
Route::get('/editTechnicalProgram','AdminTechnicalProgramController@edit');
Route::post('updateTechnical','AdminTechnicalProgramController@update');
Route::post('deleteTechnical','AdminTechnicalProgramController@delete');




//searches button
Route::get('/get_data_search_user','AdminUserManagementController@getdatasearch');
Route::get('/get_data_search_sy','AdminSchoolYearController@getdatasearch');
Route::get('/get_data_search_advance','AdminAdvanceProgramController@getdatasearch');



Route::get('/getidSem','AdminSemesterController@editStatus');
Route::get('/getidCampus','AdminCampusController@edit');
Route::get('/getidYear','AdminSchoolYearController@editStatus');
Route::get('/getidHigher', 'AdminHigherEducationController@edit');
Route::get('/getidTechnical', 'AdminTechnicalProgramController@edit');
Route::post('/deleteHigher', 'AdminHigherEducationController@delete');
Route::post('/deleteTechnical', 'AdminTechnicalProgramController@delete');
Route::post('/deleteSy','AdminSchoolYearController@delete');
Route::post('/deleteSem','AdminSemesterController@delete');
Route::post('/deleteCamp','AdminCampusController@delete');


//IPO

// Route::get('/ipo_main','IPOMainController@index')->name('ipo_main');
Route::get('/ipo_enrollment','IPOMainController@enrollment')->name('ipo_enroll');
Route::get('/ipo_faculty','IPOMainController@faculty')->name('ipo_faculty');
Route::get('/ipo_facility','IPOMainController@facility')->name('ipo_facility');
Route::get('/ipo_admin','IPOMainController@admin')->name('ipo_admin');
// Route::get('/ipo_campus','IPOMainController@index2')->name('ipo_camp');
///for enrollment
Route::Get('/exceldes','IPOMainController@export');
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'IPOMainController@importHE'));
//for faculty
Route::Get('/exceldes-faculty','IPOMainController@exportfaculty');
Route::post('import-csv-excel-faculty',array('as'=>'import-csv-excel-faculty','uses'=>'IPOMainController@importfaculty'));
//Route::Get('/exceldes','IPOMainController@export');
//Route::Post('/importHE','IPOMainController@import');





Route::get('/qwerty','ChaController@cha');
Route::get('/child','ChaController@child')->name('chacha');

Route::get('/admin_performance_points','AdminPerformancePointsController@index')->name('admin_points');
Route::get('/admin_performance_deadline','AdminPerformanceDeadlineController@index')->name('admin_deadline');