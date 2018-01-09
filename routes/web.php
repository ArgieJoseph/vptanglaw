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
//For Login Auth
Auth::routes();



//HOMEPAGES
Route::GET('/admin/home','AdminController@index');
Route::get('/director','DirectorController@index');
Route::get('/registrar','RegistrarController@index');
Route::get('/ipo','IPOController@index');
Route::get('/vp','VPController@index');


//USER PROFILE
Route::GET('/profile','AdminProfileController@profiles')->name('profile');
Route::Post('/profile','AdminProfileController@updateavatar');


//---------------------ADMIN ROUTES-----------------------//
//ADMIN SETUPS
//SEMESTER
Route::post('addSemester','AdminSemesterController@create');
Route::get('/searchsem','AdminSemesterController@search');
Route::get('/admin_semester','AdminSemesterController@index')->name('admin_sem');
Route::get('/editSemester','AdminSemesterController@edit');
Route::post('/updateSemester','AdminSemesterController@update');
Route::post('/updateSemesterStatus','AdminSemesterController@updateStatus');
Route::get('/editSemesterStatus','AdminSemesterController@editStatus');
Route::post('/deleteSemester','AdminSemesterController@delete');
Route::get('/getidSem','AdminSemesterController@editStatus');
//SCHOOLYEAR
Route::get('/admin_schoolyear','AdminSchoolYearController@index')->name('admin_sy');
Route::post('/addSchoolYear','AdminSchoolYearController@create');
Route::post('/deleteYear','AdminSchoolYearController@delete');
Route::get('/editSchoolYearStatus','AdminSchoolYearController@editStatus');
Route::post('/updateSchoolYearStatus','AdminSchoolYearController@updateStatus');
Route::get('/editSchoolYear','AdminSchoolYearController@edit');
Route::post('/updateSchoolYear','AdminSchoolYearController@update');
Route::get('/getidYear','AdminSchoolYearController@editStatus');
Route::post('/deleteSy','AdminSchoolYearController@delete');
//PROGRAM
//HIGHER PROGRAM
Route::get('/admin_program_higher','AdminHigherEducationController@index')->name('admin_high');
Route::post('addHigherEducation','AdminHigherEducationController@create');
Route::get('editHigherEducation','AdminHigherEducationController@edit');
Route::post('updateHigher','AdminHigherEducationController@update');
Route::get('/getidHigher', 'AdminHigherEducationController@edit');
Route::post('/deleteHigher', 'AdminHigherEducationController@delete');
//TECHNICAL PROGRAM
Route::get('/admin_program_technical','AdminTechnicalProgramController@index')->name('admin_tech');
Route::post('addTechnicalProgram','AdminTechnicalProgramController@create');
Route::get('/editTechnicalProgram','AdminTechnicalProgramController@edit');
Route::post('updateTechnical','AdminTechnicalProgramController@update');
Route::get('/getidTechnical', 'AdminTechnicalProgramController@edit');
Route::post('/deleteTechnical', 'AdminTechnicalProgramController@delete');
//CAMPUS
Route::get('/getidCampus','AdminCampusController@edit');
Route::post('/deleteSem','AdminSemesterController@delete');
Route::post('/deleteCamp','AdminCampusController@delete');
// ADMIN SEARCH BUTTONS
Route::get('/get_data_search_user','AdminUserManagementController@getdatasearch');
Route::get('/get_data_search_sy','AdminSchoolYearController@getdatasearch');
Route::get('/get_data_search_advance','AdminAdvanceProgramController@getdatasearch');
//ADMIN USER MANGEMENT
Route::get('/admin_user_management','AdminUserManagementController@index')->name('admin_um');
Route::post('addUser','AdminUserManagementController@myformPost');
Route::get('editUser','AdminUserManagementController@edit');
Route::post('updateUser','AdminUserManagementController@update');
Route::get('/editUserStatus','AdminUserManagementController@editStatus');
Route::post('updateUserStatus','AdminUserManagementController@updateStatus');
//ADMIN AJAX TABLES
Route::get('/admin_campus','AdminCampusController@index');
Route::post('/table','AdminCampusController@create');
Route::get('/admin_campus_table','AdminCampusController@read');
Route::post('/','AdminCampusController@delete');
Route::get('/edit','AdminCampusController@edit');
Route::post('/update','AdminCampusController@update');
Route::get('/get_data_search','AdminCampusController@get_data_search');
Route::get('/search','AdminCampusController@search');
//ADMIN LOGIN/PASSWORD CONFIG
Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin','Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
//ADMIN EVALUATION SETUP
Route::get('/admin_performance_points','AdminPerformancePointsController@index')->name('admin_points');
Route::get('/admin_performance_deadline','AdminPerformanceDeadlineController@index')->name('admin_deadline');


//---------------------REGISTRAR ROUTES---------------------------------------------------------------------------------//
Route::get('/rg_enrollment','RegistrarEnrollmentController@index')->name('rg_enroll');
Route::get('/rg_faculty','RegistrarFacultyController@index')->name('rg_faculty');
Route::get('/rg_facility','RegistrarFacilityController@index')->name('rg_facility');
Route::get('/rg_admin','RegistrarAdministrativeController@index')->name('rg_admin');
//ENROLLMENT
Route::Get('/exceldes-reg','RegistrarEnrollmentController@export'); 
Route::post('import-csv-excel-reg',array('as'=>'import-csv-excel-reg','uses'=>'RegistrarEnrollmentController@import'));
//FACULTY
Route::Get('/exceldes-faculty-reg','RegistrarFacultyController@export'); 
Route::post('import-csv-excel-faculty-reg',array('as'=>'import-csv-excel-faculty-reg','uses'=>'RegistrarFacultyController@import'));
//ADMINISTRATIVE
Route::Get('/exceldes-admin-reg','RegistrarAdministrativeController@export');
Route::post('import-csv-excel-admin-reg',array('as'=>'import-csv-excel-admin-reg','uses'=>'RegistrarAdministrativeController@import'));
//FACILITY
Route::Get('/exceldes-facility-reg','RegistrarFacilityController@export');
Route::post('import-csv-excel-facility-reg',array('as'=>'import-csv-excel-facility-reg','uses'=>'RegistrarFacilityController@import'));




//---------------------VICE PRESIDENT ROUTES----------------------------------------------------------------------------//
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
Route::get('/vp_search_enrollment', 'VPPagesController@search');





//IPO

Route::get('/ipo_enrollment','IPOEnrollmentController@enrollment')->name('ipo_enroll');
Route::get('/ipo_faculty','IPOFacultyController@faculty')->name('ipo_faculty');
Route::get('/ipo_facility','IPOFacilityController@facility')->name('ipo_facility');
Route::get('/ipo_admin','IPOAdminController@admin')->name('ipo_admin');
Route::get('/ipo_graduate','IPOGraduateController@graduate')->name('ipo_grad');
Route::get('/ipo_licensure','IPOLicensureController@licensure')->name('ipo_licen');
///for enrollment
Route::Get('/exceldes','IPOEnrollmentController@export');
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'IPOEnrollmentController@importHE'));
//for faculty
Route::Get('/exceldes-faculty','IPOFacultyController@exportfaculty');
Route::post('import-csv-excel-faculty',array('as'=>'import-csv-excel-faculty','uses'=>'IPOFacultyController@import'));

Route::Get('/exceldes-admin','IPOAdminController@exportAdmin');
Route::post('import-csv-excel-admin',array('as'=>'import-csv-excel-admin','uses'=>'IPOAdminController@import'));

Route::Get('/exceldes-facility','IPOFacilityController@exportFacility');
Route::post('import-csv-excel-facility',array('as'=>'import-csv-excel-facility','uses'=>'IPOFacilityController@import'));

Route::Get('/exceldes-licensure','IPOLicensureController@exportLicensure');
Route::post('import-csv-excel-licensure',array('as'=>'import-csv-excel-licensure','uses'=>'IPOLicensureController@import'));

Route::Get('/exceldes-graduate','IPOGraduateController@exportGraduate');
Route::post('import-csv-excel-graduate',array('as'=>'import-csv-excel-graduate','uses'=>'IPOGraduateController@import'));



// Route::Get('/excel','ExcelController@export');
// Route::get('/upload','ExcelController@upload');
// Route::POST('/import','ExcelController@import');




//testing vue

Route::get('/', function() {
    // this doesn't do anything other than to
    // tell you to go to /fire
    return "go to /fire";
});

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\EventName());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});