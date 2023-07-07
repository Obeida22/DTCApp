<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserStudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\RollController;
use App\Http\Controllers\Api\SpeciltyController;
use App\Http\Controllers\Api\ConsultingController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\WishesStudentController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\IncomingConsultingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AnnouncingCourseController;
use App\Http\Controllers\Api\ShortCoursController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\ShortCoursDocsController;
use App\Http\Controllers\Api\StudentDocesController;
use App\Http\Controllers\Api\StudentModeController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\LeafletController;
use App\Http\Controllers\Api\MovingRequestController;
use App\Http\Controllers\Api\EditingMarksRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);
});


Route::apiResource('students', UserStudentController::class);
Route::apiResource('users', UserStudentController::class);
Route::get('/students', [UserStudentController::class, 'index'])->name('users.index');
Route::get('/students/create', [UserStudentController::class, 'create'])->name('users.create');
Route::post('/students', [UserStudentController::class, 'store'])->name('users.store');
Route::get('/students/{student}/edit', [UserStudentController::class, 'edit'])->name('users.edit');
Route::put('/students/{student}', [UserStudentController::class, 'update'])->name('users.update');
Route::delete('/students/{student}', [UserStudentController::class, 'destroy'])->name('users.destroy');


Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);
Route::post('/teachers', [TeacherController::class, 'store']);
Route::put('/teachers/{id}', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);


Route::get('/specialty', [SpeciltyController::class, 'index']);
Route::get('/specialty/{id}', [SpeciltyController::class, 'show']);
Route::post('/specialty', [SpeciltyController::class, 'store']);
Route::put('/specialty/{id}', [SpeciltyController::class, 'update']);
Route::delete('/specialty/{id}', [SpeciltyController::class, 'destroy']);


Route::get('/rolls', [RollController::class, 'index']);
Route::get('/rolls/{id}', [RollController::class, 'show']);
Route::post('/rolls', [RollController::class, 'store']);
Route::put('/rolls/{id}', [RollController::class, 'update']);
Route::delete('/rolls/{id}', [RollController::class, 'destroy']);

Route::get('/consultings', [ConsultingController::class, 'index']);
Route::get('/consultings/{id}', [ConsultingController::class, 'show']);
Route::post('/consultings', [ConsultingController::class, 'store']);
Route::put('/consultings/{id}', [ConsultingController::class, 'update']);
Route::delete('/consultings/{id}', [ConsultingController::class, 'destroy']);


Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{id}', [ClassController::class, 'show']);
Route::post('/classes', [ClassController::class, 'store']);
Route::put('/classes/{id}', [ClassController::class, 'update']);
Route::delete('/classes/{id}', [ClassController::class, 'destroy']);


// Create a wish
Route::post('/wishes', [WishesStudentController::class, 'create']);
// Read a wish
Route::get('/wishes/{wish_id}', [WishesStudentController::class, 'read']);
// Update a wish
Route::put('/wishes/{wish_id}', [WishesStudentController::class, 'update']);
// Delete a wish
Route::delete('/wishes/{wish_id}', [WishesStudentController::class, 'delete']);


// Create a new guardian for a student
Route::post('/students/{studentId}/guardians', [GuardianController::class, 'store']);
// Update an existing guardian for a student
Route::put('/students/{studentId}/guardians/{guardianId}', [GuardianController::class, 'update']);
// Delete an existing guardian for a student
Route::delete('/students/{studentId}/guardians/{guardianId}', [GuardianController::class, 'destroy']);


Route::get('/incoming_consultings', [IncomingConsultingController::class, 'index']);
Route::get('/incoming_consultings/{Consulting_ID}/{User_ID}', [IncomingConsultingController::class, 'show']);
Route::post('/incoming_consultings', [IncomingConsultingController::class], 'store');
Route::put('/incoming_consultings/{Consulting_ID}/{User_ID}', [IncomingConsultingController::class, 'update']);
Route::delete('/incoming_consultings/{Consulting_ID}/{User_ID}', [IncomingConsultingController::class, 'destroy']);



Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);



Route::post('/announcing_courses', [AnnouncingCourseController::class, 'store']);
Route::get('/announcing_courses/{id}', [AnnouncingCourseController::class, 'show']);
Route::put('/announcing_courses/{id}', [AnnouncingCourseController::class, 'update']);
Route::delete('/announcing_courses/{id}', [AnnouncingCourseController::class, 'destroy']);


Route::get('/short_courses', [ShortCoursController::class, 'index']);
Route::post('/short_courses', [ShortCoursController::class, 'store']);
Route::get('/short_courses/{id}', [ShortCoursController::class, 'show']);
Route::put('/short_courses/{id}', [ShortCoursController::class, 'update']);
Route::delete('/short_courses/{id}', [ShortCoursController::class, 'destroy']);




Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);


Route::get('/materials', [MaterialController::class, 'index']);
Route::post('/materials', [MaterialController::class, 'store']);
Route::get('/materials/{id}', [MaterialController::class, 'show']);
Route::put('/materials/{id}', [MaterialController::class, 'update']);
Route::delete('/materials/{id}', [MaterialController::class, 'destroy']);



Route::get('/leaflets', [LeafletController::class, 'index']);
Route::post('/leaflets',  [LeafletController::class, 'store']);
Route::get('/leaflets/{id}',  [LeafletController::class, 'show']);
Route::put('/leaflets/{id}',  [LeafletController::class, 'update']);
Route::delete('/leaflets/{id}',  [LeafletController::class, 'destroy']);


Route::get('/moving_requests', [MovingRequestController::class, 'index']);
Route::get('/moving_requests/{id}', [MovingRequestController::class, 'show']);
Route::post('/moving_requests', [MovingRequestController::class, 'store']);
Route::put('/moving_requests/{id}', [MovingRequestController::class, 'update']);
Route::delete('/moving_requests/{id}', [MovingRequestController::class, 'destroy']);


Route::get('/editing_marks_requests', [EditingMarksRequestController::class, 'index']);
Route::get('/editing_marks_requests/{id}', [EditingMarksRequestController::class, 'show']);
Route::post('/editing_marks_requests', [EditingMarksRequestController::class, 'store']);
Route::put('/editing_marks_requests/{id}', [EditingMarksRequestController::class, 'update']);
Route::delete('/editing_marks_requests/{id}', [EditingMarksRequestController::class, 'destroy']);


Route::get('/departments', [DepartmentsController::class, 'index']);
Route::get('/departments/{department}',  [DepartmentsController::class, 'show']);
Route::post('/departments',  [DepartmentsController::class, 'store']);
Route::put('/departments/{department}', [DepartmentsController::class, 'update']);
Route::delete('/departments/{department}', [DepartmentsController::class, 'destroy']);


Route::post('/short_courses/{stu_id}/docs', [ShortCoursDocsController::class, 'store']);
Route::get('/short_courses/{stu_id}/docs', [ShortCoursDocsController::class, 'show']);
Route::delete('/short_courses/{stu_id}/docs', [ShortCoursDocsController::class, 'destroy']);



Route::post('students/{student_id}/docs', [StudentDocesController::class, 'store']);
Route::get('students/{student_id}/docs', [StudentDocesController::class, 'show']);
Route::delete('students/{student_id}/docs', [StudentDocesController::class, 'destroy']);



Route::post('/students/{studentId}/student_mode', [StudentModeController::class, 'store']);
Route::put('/students/{studentId}/student_mode', [StudentModeController::class, 'update']);
Route::delete('/students/{studentId}/studen_-mode', [StudentModeController::class, 'destroy']);
