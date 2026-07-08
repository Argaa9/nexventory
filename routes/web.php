<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Models\Testimonial;




/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Users
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Products
    | Admin + Staff
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'products',
        ProductController::class
    )->middleware('role:admin,staff');

    /*
    |--------------------------------------------------------------------------
    | Borrowings
    | Admin + Staff
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'borrowings',
        BorrowingController::class
    )->middleware('role:admin,staff');

    Route::put(
        '/borrowings/{borrowing}/return',
        [BorrowingController::class, 'returnItem']
    )
    ->name('borrowings.return')
    ->middleware('role:admin,staff');

    /*
    |--------------------------------------------------------------------------
    | History
    | Admin + Staff
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/history',
        [BorrowingController::class, 'history']
    )
    ->name('history')
    ->middleware('role:admin,staff');

    /*
    |--------------------------------------------------------------------------
    | Reports
    | Admin + Manager
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )
    ->name('reports.index')
    ->middleware('role:admin,manager');

    Route::get(
        '/reports/export/pdf',
        [ReportController::class, 'exportPdf']
    )
    ->name('reports.pdf')
    ->middleware('role:admin,manager');

    Route::get(
        '/reports/export/excel',
        [ReportController::class, 'exportExcel']
    )
    ->name('reports.excel')
    ->middleware('role:admin,manager');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


Route::get(
    '/users',
    [UserController::class,'index']
)
->name('users.index')
->middleware('role:admin');

Route::post(
    '/users',
    [UserController::class,'store']
)
->name('users.store')
->middleware('role:admin');

Route::put(
    '/users/{user}',
    [UserController::class,'update']
)
->name('users.update')
->middleware('role:admin');

Route::delete(
    '/users/{user}',
    [UserController::class,'destroy']
)
->name('users.destroy')
->middleware('role:admin');


Route::get('/', function () {

    $testimonials = Testimonial::with('user')
        ->latest()
        ->take(6)
        ->get();

    return view(
        'welcome',
        compact('testimonials')
    );
});

Route::middleware('auth')->group(function () {

    Route::get(
        '/testimonial',
        [TestimonialController::class, 'index']
    )->name('testimonial.index');

    Route::post(
        '/testimonial',
        [TestimonialController::class, 'store']
    )->name('testimonial.store');

});
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';