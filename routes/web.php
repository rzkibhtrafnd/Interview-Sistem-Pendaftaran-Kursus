<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseMaterialController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\User\CourseController as UserCourseController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\MyCourseController;
use App\Http\Controllers\User\CertificateController;
use App\Http\Controllers\User\UserMaterialProgressController;

/*
|--------------------------------------------------------------------------
| HOME (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [UserCourseController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('dashboard'))
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('course-materials', CourseMaterialController::class);

        Route::get('/transactions', [AdminTransactionController::class, 'index'])
            ->name('transactions.index');

        Route::get('/transactions/{order}', [AdminTransactionController::class, 'show'])
            ->name('transactions.show');

        Route::get('/transactions-export/pdf', 
            [AdminTransactionController::class, 'exportPdf'])
            ->name('transactions.export.pdf');

        Route::get('/transactions-export/excel', 
            [AdminTransactionController::class, 'exportExcel'])
            ->name('transactions.export.excel');
    });

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/courses', [UserCourseController::class, 'index'])
        ->name('courses.index');

    Route::get('/courses/{course}', [UserCourseController::class, 'show'])
        ->name('courses.show');

    Route::post('/courses/{course}/buy', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::get('/my-courses', [MyCourseController::class, 'index'])
        ->name('my-courses.index');

    Route::get('/my-courses/{course}', [MyCourseController::class, 'show'])
        ->name('my-courses.show');

    Route::post('/materials/{material}/complete', 
        [UserMaterialProgressController::class, 'store']
    )->name('materials.complete');

    Route::get('/certificates/{course}', 
        [CertificateController::class, 'download']
    )->name('certificates.download');

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('/transactions/{order}', [TransactionController::class, 'show'])
        ->name('transactions.show');

    Route::get('/transactions/{order}/invoice', [TransactionController::class, 'invoice'])
        ->name('transactions.invoice');
});

/*
|--------------------------------------------------------------------------
| PROFILE (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
