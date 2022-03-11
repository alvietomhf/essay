<?php

use App\Http\Controllers\ClasController;
use App\Http\Controllers\ClasSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
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

    Route::get('{kelasId}/ujian/create', [ExamController::class, 'create'])->name('ujian.create');
    Route::get('{kelasId}/ujian/{exam:slug}/edit', [ExamController::class, 'edit'])->name('ujian.edit');
    Route::get('{kelasId}/ujian/{exam:slug}', [ExamController::class, 'show'])->name('ujian.show');
    Route::get('{kelasId}/ujian/{exam:slug}/preview', [ExamController::class, 'preview'])->name('ujian.preview');
    Route::get('{kelasId}/ujian/{exam:slug}/hasil', [ExamController::class, 'showResult'])->name('ujian.show.result');
    Route::post('{kelasId}/ujian', [ExamController::class, 'store'])->name('ujian.store');
    Route::put('{kelasId}/ujian/{exam:slug}', [ExamController::class, 'update'])->name('ujian.update');
    Route::put('{kelasId}/ujian/{exam:slug}/status', [ExamController::class, 'status'])->name('ujian.status');
    Route::put('{kelasId}/ujian/{exam:slug}/mix', [ExamController::class, 'mixQuestion'])->name('ujian.mix');
    Route::delete('{kelasId}/ujian/{exam:slug}', [ExamController::class, 'destroy'])->name('ujian.destroy');

    Route::post('{kelasId}/ujian/{exam:slug}/question', [QuestionController::class, 'store'])->name('soal.store');
    Route::put('{kelasId}/ujian/{exam:slug}/question', [QuestionController::class, 'update'])->name('soal.update');
});

Route::get('siswa', [StudentController::class, 'code'])->name('student.code');
Route::get('{kelasId}/ujian/{exam:slug}/siswa/{siswaId}', [StudentController::class, 'showExam'])->middleware('session')->name('student.exam.show');
Route::post('siswa/join', [StudentController::class, 'joinExam'])->name('student.exam.join');
Route::post('{kelasId}/ujian/{exam:slug}/siswa/{siswaId}/store', [ResultController::class, 'storeExam'])->name('student.exam.store');
