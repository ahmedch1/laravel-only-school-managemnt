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

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::post('contact_admin', [ContactController::class, 'InternauteContact'])->name('contact.admin');
Route::get('admin_messages', [ContactController::class, 'Aindex'])->name('message.admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth', 'role:Admin']], function () {

    //contact parents
Route::get('admin_parent', [ContactController::class, 'AdminContactP'])->name('admin.parent');
Route::post('admin_contact_parent', [ContactController::class, 'AdminContactParent'])->name('admin.contact.parent');
//contact students
Route::get('admin_student', [ContactController::class, 'AdminContactS'])->name('admin.student');
Route::post('admin_contact_student', [ContactController::class, 'AdminContactStudent'])->name('admin.contact.student');


    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('actualite', 'ActualiteController');
    Route::resource('payment', 'PaymentController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('students', 'StudentController');

    Route::resource('emplois', 'EmploiController');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');
    Route::get('students/contact/{id}', 'StudentController@contact')->name('students.contact');
    Route::get('parents/contact/{id}', 'ParentsController@contact')->name('parent.contact');
    Route::get('teacher/contact/{id}', 'TeacherController@contact')->name('teacher.contact');

});

Route::group(['middleware' => ['auth','role:Teacher']], function ()
{
    Route::resource('trims','TrimesterController');
    Route::resource('hebdos','HebdomadaireController');

    Route::get('evaluation', 'EvaluationController@index')->name('ev');
    Route::get('evaluationShow/{student}', [EvaluationController::class, 'show'])->name('evs');
    Route::get('evaluationEdit/{student}', [EvaluationController::class, 'edit'])->name('eve');
    Route::put('evaluationUpdate/{student}', [EvaluationController::class, 'update'])->name('evu');

    Route::resource('notes','NoteController');
//partie présence
    Route::post('attendances', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
    Route::get('attendance-createa/{classid}', 'AttendanceController@createaByTeacher')->name('teacher.attendance.createa');


    Route::put('updatea/{id}', 'StudentController@updatea')->name('student.updatea');
    Route::get('editea/{id}', 'StudentController@editea')->name('student.editea');
// endPart

Route::get('teacher_messages', [ContactController::class, 'Tindex'])->name('message.teacher');
//contact admin
Route::get('teacher_admin', [ContactController::class, 'TeacherContactA'])->name('teacher.admin');
Route::post('teacher_contact_admin', [ContactController::class, 'TeacherContactAdmin'])->name('teacher.contact.admin');
//contact parents
Route::get('teacher_parent', [ContactController::class, 'TeacherContactP'])->name('teacher.parent');
Route::post('teacher_contact_parent', [ContactController::class, 'TeacherContactParent'])->name('teacher.contact.parent');
//contact students
Route::get('teacher_student', [ContactController::class, 'TeacherContactS'])->name('teacher.student');
Route::post('teacher_contact_student', [ContactController::class, 'TeacherContactStudent'])->name('teacher.contact.student');

});


//done
Route::group(['middleware' => ['auth', 'role:Parent']], function () {
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');

    Route::get('pevaluation', 'EvaluationController@index')->name('pev');
    Route::get('pevaluationShow/{student}', [EvaluationController::class, 'show'])->name('pevs');

    Route::get('trimsindexparents', 'TrimesterController@indexparent')->name('trim.indexparent');
    Route::get('hebdoindexparents', 'HebdomadaireController@indexparent')->name('hebdo.indexparent');
    Route::get('trimsindexparents/{trim}','TrimesterController@show')->name('trim.show');
    Route::get('hebdoindexparents/{hebdo}','HebdomadaireController@show')->name('hebdo.show');

    Route::get('ParentNotes','NoteController@index')->name('pare.note');
    Route::get('ParentNotes/{note}','NoteController@show')->name('pare.show');

    Route::resource('student','StudentController');
});



//done
Route::group(['middleware' => ['auth', 'role:Student']], function () {
    Route::get('trimsindexstudent', 'TrimesterController@indexparent')->name('trims.indexstudent');
    Route::get('hebdoindexstudent', 'HebdomadaireController@indexparent')->name('hebdos.indexstudent');
    Route::get('trimsindexstudent/{trim}','TrimesterController@show')->name('trims.show');
    Route::get('hebdoindexstudent/{hebdo}','HebdomadaireController@show')->name('hebdos.show');

    Route::get('trimsindexstudent/download/{file}','TrimesterController@download')->name('trims.download');
    Route::get('hebdoindexstudent/download/{file}','HebdomadaireController@download')->name('hebdos.download');
    Route::get('StudentNotes','NoteController@index')->name('stud.note');
    Route::get('StudentNotes/{note}','NoteController@show')->name('stud.show');
});
