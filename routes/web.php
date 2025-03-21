<?php

use App\Models\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\GradeBookController;
use App\Http\Controllers\LessonPlanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PortalSettingController;
use App\Http\Controllers\ClassAllocationController;
use App\Http\Controllers\ManagePermissionController;
use App\Http\Controllers\PaymentActivationController;
use App\Http\Controllers\SubjectAllocationController;
use App\Http\Controllers\SubjectRegistrationController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});

Route::get('/api/get-lgas/{state_id}', [StudentController::class, 'getLgaById']);

Route::get('/api/get-class/{class_category_id}', [StudentController::class, 'getClassesByCategory']);

Route::middleware('auth')->group(function () {

    Route::resource('/permissions', PermissionController::class);
    Route::resource('/roles', RoleController::class);
    Route::get('manage-permissions', [ManagePermissionController::class,'managePermissions'])->name('manage.permissions.index');
    Route::post('assign-permissions', [ManagePermissionController::class,'assignPermissions'])->name('assign.permissions');
    Route::get('/api/permissions', [PermissionController::class, 'apiPermissions'])->name('permissions.api');

    Route::resource('portal_settings', PortalSettingController::class);
    Route::resource('sessions', SessionController::class);
    Route::put('toogle-session/{id}', [SessionController::class, 'toogleStatus']);
    Route::resource('terms', TermController::class);
    Route::put('toogle-term/{id}', [TermController::class, 'toogleStatus']);
    Route::resource('student', StudentController::class);
    Route::get('/api/students', [StudentController::class, 'getApiStudents']);
    Route::resource('payments', PaymentController::class);
    Route::get('/api/payments', [PaymentController::class, 'getApiPayments']);
    Route::get('/api/student', [StudentController::class, 'getApiStudentOption'])->name('api.student');
    Route::get('/upload/student', [StudentController::class, 'upload_student'])->name('upload.student');
    Route::post('/upload-student', [StudentController::class, 'createStudentUpload'])->name('create.student.upload');

    Route::group(['prefix' => '{type}', 'where' => ['type' => 'accountant|eo|teacher|principal|guardian']], function () {
        Route::resource('/accounts', AccountController::class);
    });

    Route::resource('payment_type', PaymentTypeController::class);
    Route::put('toogle-payment_types/{id}', [PaymentTypeController::class, 'toogleStatus']);
    Route::resource('subject-allocations', SubjectAllocationController::class);
    Route::resource('class-allocations', ClassAllocationController::class);
    Route::get('/children/{id}', [GuardianController::class, 'children'])->name('children.index');
    Route::resource('lesson_plan', LessonPlanController::class);
    Route::patch('approve/lesson-plan', [LessonPlanController::class, 'approveLessonPlan'])->name('approve.lesson_plan');

    Route::resource('settings', SettingController::class);

    Route::patch('upload-logo', [SettingController::class,'uploadLogo'])->name('upload.logo');

    Route::resource('payment_activation', PaymentActivationController::class);
    Route::put('/toogle-activate-payment/{id}', [PaymentActivationController::class, 'toogleStatus']);

    Route::resource('subject', SubjectController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('result', ResultController::class);
    Route::put('/toogle-activate-result/{id}', [ResultController::class, 'toogleStatus']);
    Route::resource('subject-registration', SubjectRegistrationController::class);

    Route::get('/api-subjects/{class_id}', [SubjectController::class,'getSubjectsByClass'])->name('api.get_subjects');

    Route::get('/add-grades/{id}', [GradeBookController::class, 'gradeMySubjectAllocation'])->name('add_grade.index');
    Route::post('/get-grades',[GradeBookController::class,'getGrade'])->name('get-grade');
    Route::post('/save_ca_result',[GradeBookController::class,'saveGrades'])->name('save_grades');
    Route::get('scores-record', [GradeBookController::class, 'uploadeScores'])->name('uploaded.scores.index');
    Route::post('scores-record', [GradeBookController::class, 'uploadeScores'])->name('uploaded.scores.get');

    Route::get('/results',[ResultController::class,'resultHome'])->name('view.result.index');
    Route::get('/results/{class_id}/{wing}',[ResultController::class,'resultHome'])->name('view.result.students');
    Route::get('/result-slip',[ResultController::class,'resultSlip'])->name('result.slip');

    Route::get('class-allocated/student/{id}', [ClassAllocationController::class, 'classStudents'])->name('class_allocated_students');

    Route::get('/student/result-slip/{student_id}/{class_id}/{session_id}/{term_id}', [GradeBookController::class, 'getStudentResult'])->name('get.result');

    Route::get('/student/make-payment/{id}', [PaymentController::class, 'makePayment'])->name('initiate.payment');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
