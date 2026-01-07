<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Api\ApiStudentController;
use App\Services\PaymentService;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-payment', function () {
    $payment = app('payment'); // The key you used in bind()
    return $payment->process();
});
//----------------authentication----------------------

Route::get('/register',[RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register',[RegisterController::class, 'store'])->name('register.store');

Route::get('/login',[LoginController::class, 'loginForm'])->name('login.form');
Route::post('/login',[LoginController::class,'check'])->name('login.store');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
                
//----------------students----------------------

Route::middleware('checkLogin')->group(function(){
    Route::get('/students',[StudentController::class,'index'])->name('students.index');

    Route::get('/students/create',[StudentController::class,'create'])->name('students.create');
    Route::post('/students',[StudentController::class,'store'])->name('students.store');

    Route::get('/students/edit/{id}',[StudentController::class, 'edit'])->name('students.edit');
    Route::post('/students/edit/{id}',[StudentController::class, 'update'])->name('students.update');

    Route::delete('/students/delete/{id}',[StudentController::class, 'destroy'])->name('students.destroy');

    Route::delete('/students/bulkDelete',[StudentController::class,'bulkDelete'])->name('students.bulkDelete');

    Route::get('/students/export', [StudentController::class, 'export'])->name('students.export');

});
//----------------teachers----------------------
Route::middleware('checkLogin','checkAdmin')->group(function(){
    Route::get('/teachers',[TeacherController::class, 'index'])->name('teachers.index');

    Route::get('/teachers/create',[TeacherController::class, 'create'])->name('teachers.createForm');
    Route::post('/teachers',[TeacherController::class, 'store'])->name('teachers.store');

    Route::put('/teachers/update-status/{id}', [TeacherController::class, 'updateStatus'])
      ->name('teachers.updateStatus');

    Route::get('/teachers/edit/{id}',[TeacherController::class, 'edit'])->name('teachers.edit');
    Route::post('/teachers/edit/{id}',[TeacherController::class, 'update'])->name('teachers.update');

    Route::delete('teachers/delete/{id}',[TeacherController::class, 'destroy'])->name('teacher.destroy');
});

//-------api----------
Route::get('/api/students',[ApiStudentController::class, 'index']);
