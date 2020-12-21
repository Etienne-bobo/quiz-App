<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\homeController;


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
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('user/quiz/{quizId}',[ExamController::class, 'getQuizQuestions'])->name('getQuizQuestions');
Route::middleware(['auth:sanctum', 'verified'])->post('quiz/test',[ExamController::class, 'postQuiz'])->name('postQuiz');
Route::middleware(['auth:sanctum', 'verified'])->get('/result/user/{userId}/quiz/{quizId}',[ExamController::class, 'viewResult'])->name('viewResult');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('home',[homeController::class, 'index'])->name('home');
Route::group(['middleware' => 'isAdmin'], function(){
    Route::resource('quiz', QuizController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('user', UserController::class);
    Route::get('exam/assign', [ExamController::class, 'create'])->name('exam.create');
    Route::get('exam/user', [ExamController::class, 'index'])->name('exam.index');
    Route::post('exam/assign', [ExamController::class, 'store'])->name('assign.store');
    Route::post('exam/remove', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::get('result', [ExamController::class, 'result'])->name('result');
    Route::get('result/{userId}/{quizId}', [ExamController::class, 'userQuizResult'])->name('userQuizResult');
    Route::get('statistics', [ExamController::class, 'statistics'])->name('statistics');

});
