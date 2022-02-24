<?php

use App\Http\Controllers\ClasController;
use App\Http\Controllers\ClasSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
]);


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboardTeacher'])->name('dashboard');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function() {
        Route::get('dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
        Route::resource('kelas', ClasController::class);
        Route::resource('mapel', SubjectController::class);
        Route::resource('guru', TeacherController::class);
        Route::resource('tapel', SeasonController::class);
        Route::group(['prefix' => 'kelas-siswa', 'as' => 'kelas-siswa.'], function() {
            Route::get('/', [StudentController::class, 'clas'])->name('clas');
            Route::get('{kelasId}', [StudentController::class, 'index'])->name('index');
            Route::get('{kelasId}/siswa/create', [StudentController::class, 'create'])->name('create');
            Route::get('{kelasId}/siswa/{id}/edit', [StudentController::class, 'edit'])->name('edit');
            Route::post('{kelasId}/siswa', [StudentController::class, 'store'])->name('store');
            Route::put('{kelasId}/siswa/{id}', [StudentController::class, 'update'])->name('update');
            Route::delete('{kelasId}/siswa/{id}', [StudentController::class, 'destroy'])->name('destroy');
        });
    });

    Route::resource('kelas-mapel', ClasSubjectController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
});

Route::get('siswa', [StudentController::class, 'code'])->name('student.code');
