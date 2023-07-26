<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', [StudentController::class, 'home']);

    Route::post('delete-students', [StudentController::class, 'deleteStudents']);

    Route::post('add-student', [StudentController::class, 'addStudent']);

});
