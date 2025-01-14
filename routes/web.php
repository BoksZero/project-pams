<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\AdmissionOfficerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


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

Route::get('/welcome', function () {
    return view('welcome');
});

//students routes
Route::get('/student/auth/login', [MainController::class, 'login'])->middleware('studentAlreadyLoggedIn');
Route::get('/student/auth/register', [MainController::class, 'register'])->middleware('studentAlreadyLoggedIn');
Route::post('/student/auth/register-student', [MainController::class, 'saveStudent'])->name('auth.save');
Route::post('/student/auth/verify', [MainController::class, 'verify'])->name('auth.verify-student');
Route::get('/student/auth/register-new-student', [MainController::class, 'registerNewStudent']);

//student profile routes
Route::get('/student/profile', [MainController::class, 'profile'])->middleware('isLoggedStudent');
Route::get('/student/auth/logout', [MainController::class, 'logout'])->name('auth.logout-student');

//update student details
Route::post('/student/profile/update', [MainController::class, 'updateStudentDetails'])->name('update-student');

//enrollment status routes
Route::get('/student/enrollment-status', [MainController::class, 'enrollmentStatus'])->name('auth.enrollment-status');
Route::get('/student/auth/faqs',[FaqsController::class, 'faqsStudent']);


//Admin routes
Route::get('/staff/auth/login', [AdminController::class, 'loginAdmin']);
Route::get('/staff/auth/register', [AdminController::class, 'register'])->middleware('adminAlreadyLoggedIn');
Route::post('/staff/auth/register-admin', [AdminController::class, 'saveAdmin'])->name('auth.save-admin');

//update admin user credentials
Route::get('/staff/admin/edit/{id}', [AdminController::class, 'editAdminDetails'])->name('edit-admin');
Route::post('/staff/admin/edit', [AdminController::class, 'updateAdminDetails'])->name('update-admin');

//delete admin user
Route::get('/staff/admin/delete/{id}', [AdminController::class, 'deleteAdminUser'])->name('delete-admin');

//Verify and login admin routes
Route::post('/staff/auth/verify', [AdminController::class, 'verify'])->name('auth.verify-admin');
Route::get('/staff/admin/manage-users', [AdminController::class, 'manageUsersView'])->middleware('isLoggedAdmin');
Route::get('/staff/admin/system-configuration', [AdminController::class, 'systemConfigView'])->middleware('isLoggedAdmin');
Route::get('/staff/auth/logout', [AdminController::class, 'logoutAdmin'])->name('auth.logout-admin');

//Admission Officer Course routes
Route::get('/staff/admin/dashboard', [AdmissionOfficerController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/staff/admin/pre-enrollment/new', [AdmissionOfficerController::class, 'preEnrollmentNew'])->name('admin.pre-enrollment-new');
Route::get('/staff/admin/pre-enrollment/continuing', [AdmissionOfficerController::class, 'preEnrollmentContinuing'])->name('admin.pre-enrollment-continuing');
Route::get('/staff/admin/pending', [AdmissionOfficerController::class, 'pendingStudents'])->name('admin.pending');
Route::get('/staff/admin/enrolled', [AdmissionOfficerController::class, 'enrolledStudents'])->name('admin.enrolled');
Route::get('/staff/admin/assign-subjects', [AdmissionOfficerController::class, 'assignSubjects'])->name('admin.assign-subjects');
Route::get('/staff/admin/subjects', [AdmissionOfficerController::class, 'subjectList'])->name('admin.subjects');
Route::get('/staff/admin/thesis-management', [AdmissionOfficerController::class, 'thesisManagement'])->name('admin.thesis-management');

Route::post('/staff/admin/subjects', [AdmissionOfficerController::class, 'saveSubject'])->name('auth.save-subject');


//Route::get('/staff/admission-officer/msit', [AdmissionOfficerController::class, 'admissionOfficerMSITView'])->name('msit-students');

//Students
//delete pending students
Route::get('/staff/admission-officer/delete/{id}', [AdmissionOfficerController::class, 'deletePendingStudent'])->name('mit-delete-student');
//delete enrolled MIT Student
Route::get('/staff/admission-officer/delete/enrolled/{id}', [AdmissionOfficerController::class, 'deleteEnrolledStudent'])->name('delete-enrolled-mit');
//approve students
Route::get('/staff/admission-officer/edit/{id}', [AdmissionOfficerController::class, 'editPendingStudent'])->name('mit-edit-student');
Route::post('/staff/admission-officer/edit', [AdmissionOfficerController::class, 'approvePendingStudent'])->name('approve-student');

//Admission routes
Route::get('/enrollment', [MainController::class, 'admission'])->name('enrollment');

//Thesis Management
Route::get('/student/auth/thesis-management', [MainController::class, 'thesisManagement'])->name('thesis-management');
//Insertion of Data for Thesis Management
Route::post('/staff/admin/thesis-management', [MainController::class, 'thesisInsert'])->name('insert-thesis');
//Monitoring of Thesis Title & Author
Route::get('/staff/admin/thesis-monitoring', [MainController::class, 'saveThesisMonitoring'])->name('admin.thesis-list');



